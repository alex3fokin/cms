@extends('backend.layouts.index')

@section('content')
    <div>
        <div class="row media-page-container">
            @foreach($media as $media_item)
                <div class="col s3">
                    <div class="card media-item z-depth-3">
                        <div class="card-image">
                            <img src="{{$media_item['path']}}">
                            <div class="card-image-cover">
                                <p class="card-image-name">
                                    {{$media_item['name']}}
                                </p>
                                <button class="btn-floating waves-effect waves-light red"
                                        data-name="{{$media_item['name']}}"
                                        onclick="deleteMediaFile(this)"><i class="material-icons">delete</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fixed-action-btn">
        <input type="file" name="files" id="media_upload_input" multiple class="btn-floating btn-large" style="position:relative; z-index: 2; opacity: 0">
        <button id="btn_upload" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes"
        style="position: absolute; top:15px;">
            <i class="large material-icons">cloud_upload</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        function deleteMediaFile(elem) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.file.delete')}}',
                data: {name: $(elem).data('name'), _method: 'DELETE'},
                success: function (data) {
                    console.log(data);
                    $(elem).parent().parent().parent().remove();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function() {

            $('#media_upload_input').change(function () {
                var length = this.files.length;
                var data = new FormData();
                for (i = 0; i < length; i++) {
                    data.append('file[]', this.files[i]);
                }
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.file.upload')}}',
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function (data) {
                        console.log(data);
                        file = data.file;
                        $('.media-page-container').append('<div class="col s3">\n' +
                            '                    <div class="card media-item z-depth-3">\n' +
                            '                        <div class="card-image">\n' +
                            '                            <img src="' + file.path + '">\n' +
                            '                            <div class="card-image-cover">\n' +
                            '                                <p class="card-image-name">\n' +
                            '                                    ' + file.name + '\n' +
                            '                                </p>\n' +
                            '                                <button class="btn-floating waves-effect waves-light red" data-name="' + file.name + '"\n' +
                            '                                        onclick="deleteMediaFile(this)"><i class="material-icons">delete</i></button>\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>');
                        $('.media-item').click(function () {
                            $('.media-container').find('.media-item.active').removeClass('active');
                            $(this).addClass('active');
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $('.media-item').click(function () {
                $('.media-container').find('.media-item.active').removeClass('active');
                $(this).addClass('active');
            });

        });
    </script>
@endpush