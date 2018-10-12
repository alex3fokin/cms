@extends('backend.layouts.index')

@section('content')
    <div>
        <div class="row">
            <div class="col s2">
                <p>
                    <b>Select language</b>
                </p>
            </div>
            <div class="col s10">
                <select id="locale_select_id">
                    <option value="" selected>Choose language</option>
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($current_locale) === intval($locale->id) ? "selected" : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h1 class="center-align">Edit category</h1>
        <div class="row">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#main_tab">Main</a></li>
                <li class="tab"><a href="#seo_tab">SEO</a></li>
            </ul>
        </div>
        <div id="main_tab">
            <div class="row">
                <form id="form_update_category" onkeypress="return event.keyCode != 13;" class="col s12">
                    <div class="input-field col s5">
                        <label class="active" for="category_title">Title</label>
                        <input type="text" name="category_title" id="category_title" value="{{$category->title}}">
                    </div>
                    <div class="input-field col s5">
                        <label class="active" for="category_url">URL</label>
                        <input type="text" name="category_url" id="category_url" value="{{$category->self_url}}">
                    </div>
                    <div class="input-field col s2">
                        <label class="active" for="category_per_page">Per page <i class="material-icons tooltipped" data-position="top" data-tooltip="Number specify how much pages will be displayed per one category page<br>If set 0 all pages will be displayed">info</i></label>
                        <input type="number" id="category_per_page" name="category_per_page" min="0" step="1" value="{{$category->per_page}}">
                    </div>
                    <div class="input-field col s12">
                        <label for="category_design_blocks" class="active">Choose excerpt design blocks</label>
                        <select type="text" name="category_design_blocks" id="category_design_blocks" multiple>
                            <option value="" selected disabled></option>
                            @php
                                $category_design_blocks = explode(',',$category->design_blocks);
                            @endphp
                            @foreach($design_blocks as $design_block)
                                <option value="{{$design_block->title}}" {{in_array($design_block->title, $category_design_blocks) ? 'selected' : ''}}>{{$design_block->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label for="category_page_template_id" class="active">Choose page template</label>
                        <select name="category_page_template_id" id="category_page_template_id">
                            <option value="" disabled selected></option>
                            @foreach($page_templates as $page_template)
                                <option value="{{$page_template->id}}" {{$category->page_template_id === $page_template->id ? 'selected' : ''}}>{{$page_template->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label for="category_parent_id" class="active">Choose parent category</label>
                        <select name="category_parent_id" id="category_parent_id">
                            <option value="" disabled selected></option>
                            @foreach($categories as $category_item)
                                <option value="{{$category_item->id}}" {{$category->parent_category === $category_item->id ? 'selected' : ''}}>{{$category_item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div id="seo_tab">
            <div class="row">
                <div class="input-field col s6">
                    <label for="category_description">Description</label>
                    <textarea form="form_update_category" id="category_description" class="materialize-textarea" name="category_description">{{$category->seo->description}}</textarea>
                </div>
                <div class="input-field col s6">
                    <label for="category_keywords">Keywords</label>
                    <textarea form="form_update_category" name="category_keywords" id="category_keywords" class="materialize-textarea">{{$category->seo->keywords}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_category" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('.tab').click(function () {
                window.location = window.location.origin + window.location.pathname + window.location.search + $(this).find('a').attr('href');
            });

            $('#form_update_category').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{route('api.category.update')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: {{$category->id}},
                        title: $('#category_title').val(),
                        url: $('#category_url').val(),
                        per_page: $('#category_per_page').val(),
                        design_blocks: $('#category_design_blocks').val(),
                        parent_category: $('#category_parent_id').val(),
                        page_template_id: $('#category_page_template_id').val(),
                        description: $('#category_description').val(),
                        keywords: $('#category_keywords').val(),
                        locale_id: $('#locale_select_id').val(),
                        _method: 'PUT'
                    },
                    success: function(data) {
                        console.log(data);
                        M.toast({html: 'Success! Category has been updated', classes: 'green'});
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Category hasn\'t been updated', classes: 'red'});
                    }
                });
            });

            $('#btn_update_category').click(function() {
                $('#form_update_category').submit();
            });
        });
    </script>
@endpush