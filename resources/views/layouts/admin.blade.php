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
    <nav class="nav-extended">
        <div class="row">
            <div class="col s12">
                <select id="locale_select_id">
                    <option value="" selected>Choose language</option>
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($current_locale) === intval($locale->id) ? "selected" : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">ADmin</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s2"><a href="#locales">Locales</a></li>
                <li class="tab col s2"><a href="#general">General</a></li>
                <li class="tab col s2"><a href="#widgets_content">Widgets content</a></li>
                <li class="tab col s2"><a href="#pages">Pages</a></li>
                <li class="tab col s2"><a href="#pages_contents">Pages contents</a></li>
                <li class="tab col s2"><a href="#menus">Menus</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li>
            {{ Auth::user()->name }} <span class="caret"></span>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    <div class="row">
        @yield('content')
    </div>
</div>
<div id="modalPullOfFiles" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <div class="dropzone"></div>
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

    $(document).ready(function () {
        $('#locale_select_id').change(function() {
            window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
        });
        $('.wysiwyg-textarea').each(function() {
            CKEDITOR.replace($(this).attr('id'));
        });
        $('.sidenav').sidenav();
        $('.tabs').tabs();
        $(".dropzone").dropzone({
            url: '{{route('api.file.upload')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            filesName: 'file',
            width: '100%',
            height: '100px',
            success: function (data) {
                var file = JSON.parse(data.response);
                file = file.file;
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
            }
        });
        $('.modal').modal();
        $('.media-item').click(function () {
            $('.media-container').find('.media-item.active').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
@stack('after-scripts')
</body>
</html>
