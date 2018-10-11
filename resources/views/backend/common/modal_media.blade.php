<div id="modalPullOfFiles" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="files" id="media_upload_input" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload one or more files">
                    </div>
                </div>
            </div>
        </div>
        <div class="row media-container">
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
        <div class="modal-footer">
            <button class="btn-floating waves-effect waves-light green modal-close" data-initiator=""
                    data-modal="#modalPullOfFiles" onclick="returnToInitiator(this)"><i class="material-icons">done</i>Select
            </button>
            <button class="btn-floating waves-effect waves-light red modal-close"><i class="material-icons">close</i>Close
            </button>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        function setInitiator(elem) {
            $('#' + $(elem).data('target')).find('button[data-initiator]').eq(0).data('initiator', $(elem).data('initiator'));
        }

        function returnToInitiator(elem) {
            $($(elem).data('initiator')).find('img').eq(0).attr('src', $($(elem).data('modal')).find('.card.media-item.active img').eq(0).attr('src'));
            console.log($($(elem).data('initiator')).find('img'));
            console.log($($(elem).data('modal')).find('.card.media-item.active .card-image-name').eq(0).html());
            $($(elem).data('initiator')).find('input[type="hidden"]').eq(0).val($($(elem).data('modal')).find('.card.media-item.active .card-image-name').eq(0).text().trim());
        }

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
                        $('.media-container').append('<div class="col s3">\n' +
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