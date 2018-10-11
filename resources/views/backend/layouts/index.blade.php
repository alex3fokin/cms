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
    @stack('after-styles')
</head>

<body>
<div class="row main-wrapper">
    <div class="col s12 card-panel header-nav">
        <div class="row">
            <div class="col s12">

                <a href="{{route('dashboard.home')}}" class="black-text logo">&mdash;board</a>

                <a href="{{route('home')}}" target="_blank" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Go to website"><i class="material-icons">home</i></a>
                @if($prev_url = url()->previous())
                    <a href="{{$prev_url}}" class="btn-floating blue tooltipped" data-position="bottom" data-tooltip="Go to the previous page"><i class="material-icons">reply</i></a>
                @endif
                @stack('additional_btns')
                <div class="right">
                    <button class="dropdown-trigger btn waves-effect waves-light" data-target='header_nav_dropdown'>
                        <i class="material-icons right">keyboard_arrow_down</i> {{ Auth::user()->name }}
                    </button>
                    <ul id='header_nav_dropdown' class='dropdown-content'>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col s2 p-0 main-nav-wrapper">
        <div class="collection m-0 main-nav-collection">
            <a href="{{route('dashboard.pages')}}" class="collection-item">
                <i class="material-icons va-b">description</i>
                Pages & Templates
            </a>
            <a href="{{route('dashboard.categories')}}" class="collection-item">
                <i class="material-icons va-b">category</i>
                Categories
            </a>
            <a href="{{route('dashboard.widgets')}}" class="collection-item">
                <i class="material-icons va-b">widgets</i>
                Widgets
            </a>
            <a href="{{route('dashboard.design_blocks')}}" class="collection-item">
                <i class="material-icons va-b">extension</i>
                Design blocks
            </a>
            <a href="{{route('dashboard.menus')}}" class="collection-item">
                <i class="material-icons va-b">menu</i>
                Menus
            </a>
            <a href="{{route('dashboard.general_info')}}" class="collection-item">
                <i class="material-icons va-b">info</i>
                General info
            </a>
            <a href="{{route('dashboard.locales')}}" class="collection-item">
                <i class="material-icons va-b">translate</i>
                Locales
            </a>
            <a href="{{route('dashboard.media')}}" class="collection-item">
                <i class="material-icons va-b">image</i>
                Media
            </a>
        </div>
    </div>
    <div class="col s10">
        @yield('content')
    </div>
</div>
<div id="ays-modal" class="modal">
    <div class="modal-content">
        <p class="center-align orange-text"><i class="material-icons fs-10x">error_outline</i></p>
        <h4 class="center-align">Deleting element</h4>
        <h5 class="center-align">Are you really want to delete that element?</h5>
    </div>
    <div class="modal-footer">
        <a href="#!" onclick="confirmDelete(-1)" class="modal-close waves-effect waves-red btn-floating white tooltipped" data-position="top" data-tooltip="Cancel">
           <i class="material-icons red-text">cancel</i>
        </a>
        <a href="#!" onclick="confirmDelete(1)" class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top" data-tooltip="Confirm">
            <i class="material-icons green-text">done</i>
        </a>
    </div>
</div>
<!--JavaScript at end of body for optimized loading-->
<script src="/js/backend/jquery-3.3.1.min.js"></script>
{{--<script src="/js/backend/jquery-ui.js"></script>--}}
{{--<script src="/js/backend/dropzone.min.js"></script>--}}
<script src="{{ asset('js/backend/app.js') }}"></script>
{{--<script src="/js/backend/bootstrap-tagsinput.min.js"></script>--}}
{{--<script src="/js/backend/ckeditor/ckeditor.js"></script>--}}
<script>
    var element_to_delete = null;
    var delete_function = null;

    function confirmDelete(state) {
        if(state === 1) {
            window[delete_function](element_to_delete);
        }
        element_to_delete = null;
        delete_function = null;
    }

    function openConfirmModal(elem, function_name) {
        element_to_delete = elem;
        delete_function = function_name;
        $('#ays-modal').modal('open');
    }

    $(document).ready(function () {
        M.AutoInit();
    });
</script>
@stack('after-scripts')
</body>
</html>