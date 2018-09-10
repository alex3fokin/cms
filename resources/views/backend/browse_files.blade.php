<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
@stack('before-styles')
<!-- Styles -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/backend/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/backend/bootstrap-tagsinput.css">
    @stack('after-styles')
</head>
<body>
<div class="row main-wrapper">
    <div>
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
            <div class="row browse-media-container">
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
                                            onclick="deleteMediaFile(this)"><i class="material-icons">delete</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn-floating waves-effect waves-light green modal-close" data-initiator=""
                        data-modal="#modalPullOfFiles" onclick="returnToInitiator(this)"><i
                            class="material-icons">done</i>Select
                </button>
                <button class="btn-floating waves-effect waves-light red modal-close"><i
                            class="material-icons">close</i>Close
                </button>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="/js/backend/jquery-3.3.1.min.js"></script>
    <script src="/js/backend/jquery-ui.js"></script>
    <script src="/js/backend/dropzone.min.js"></script>
    <script src="{{ asset('js/backend/app.js') }}"></script>
    <script src="/js/backend/bootstrap-tagsinput.min.js"></script>
    <script src="/js/backend/ckeditor/ckeditor.js"></script>
    <script>
        function setInitiator(elem) {
            $('#' + $(elem).data('target')).find('button[data-initiator]').eq(0).data('initiator', $(elem).data('initiator'));
        }

        function returnToInitiator(elem) {
            var funcNum = getUrlParam( 'CKEditorFuncNum' );
            var fileUrl = $(elem).find('img').eq(0).attr('src');
            window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
            window.close();
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

        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }

        $(document).ready(function () {
            $('.tab').click(function () {
                window.location = window.location.origin + window.location.pathname + window.location.search + $(this).find('a').attr('href');
            });
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });
            $('.wysiwyg-textarea').each(function () {
                var editor = CKEDITOR.replace($(this).attr('id'));
                var that = this;
                editor.on('instanceReady', function () {
                    $(that).parent().find('label').eq(0).addClass('active');
                });
            });
            $('.tabs').tabs();
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
                        $('.browse-media-container').append('<div class="col s3">\n' +
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
                        $('.media-item').dblclick(function() {
                            var funcNum = getUrlParam( 'CKEditorFuncNum' );
                            var fileUrl = $(this).find('img').eq(0).attr('src');
                            window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
                            window.close();
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
            $('.modal').modal();
            $('.media-item').click(function () {
                $('.media-container').find('.media-item.active').removeClass('active');
                $(this).addClass('active');
            });
            $('.media-item').dblclick(function() {
                var funcNum = getUrlParam( 'CKEditorFuncNum' );
                var fileUrl = $(this).find('img').eq(0).attr('src');
                window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
                window.close();
            });
        });
    </script>
@stack('after-scripts')
</body>
</html>
