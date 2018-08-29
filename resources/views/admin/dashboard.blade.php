@extends('layouts.admin')

@section('content')
    <div id="locales" class="col s12">
        @include('backend.parts.init.locales')
    </div>
    <div id="general" class="col s12">
        @include('backend.parts.init.general_info')
    </div>
    <div id="widgets_content" class="col-12">
        @include('backend.parts.init.widgets_content')
    </div>
    <div id="pages" class="col s12">
        @include('backend.parts.init.pages')
    </div>
    <div id="pages_contents" class="col s12">
        @include('backend.parts.init.pages_contents')
    </div>
    <div id="menus" class="col s12">
        @include('backend.parts.init.menus')
    </div>
@endsection