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
        <h1 class="center-align">Edit page</h1>
        <div class="row">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#main_tab">Main</a></li>
                <li class="tab"><a href="#seo_tab">SEO</a></li>
                <li class="tab"><a href="#categories_tab">Categories</a></li>
                <li class="tab"><a href="#content_tab">Content</a></li>
            </ul>
        </div>


        <div id="main_tab" class="col s12">
            <div class="row">
                <form id="form_update_page_main" onkeypress="return event.keyCode != 13;" class="col s12">
                    <div class="input-field col s6">
                        <label for="page_title">Title</label>
                        <input type="text" name="page_title" id="page_title" value="{{$page->title}}">
                    </div>
                    <div class="input-field col s6">
                        <label for="page_url">URL</label>
                        <input type="text" name="page_url" id="page_url" value="{{$page->self_url}}">
                    </div>
                    <div class="input-field col s12">
                        <label class="active" for="page_template_id">Page template</label>
                        <select name="page_template_id" id="page_template_id">
                            <option value="" disabled selected>Choose page template</option>
                            @foreach($page_templates as $page_template)
                                <option value="{{$page_template->id}}" {{$page->page_template_id === $page_template->id ? 'selected' : ''}}>{{$page_template->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label class="active" for="page_categories">Categories</label>
                        <select name="page_categories" id="page_categories" multiple>
                            <option value="" disabled selected></option>
                            @php
                                $page_categories = $page->categories->pluck('id')->toArray();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{in_array($category->id, $page_categories) ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div id="seo_tab" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <label for="page_description">Description</label>
                    <textarea form="form_update_page_main" id="page_description" class="materialize-textarea"
                              name="page_description">{{$page->seo->description}}</textarea>
                </div>
                <div class="input-field col s6">
                    <label for="page_keywords">Keywords</label>
                    <textarea form="form_update_page_main" name="page_keywords" id="page_keywords"
                              class="materialize-textarea">{{$page->seo->keywords}}</textarea>
                </div>
            </div>
        </div>
        <div id="categories_tab" class="col s12">
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible">
                        @foreach($page->categories_pages as $category_page)
                            <li>
                                <div class="collapsible-header">{{$category_page->category->title}}</div>
                                <div class="collapsible-body">
                                    @include('backend.parts.pages.page_edit.categories_design_blocks', ['categories_current_design_blocks' => $category_page->design_blocks, 'is_sortable' => false])
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div id="content_tab" class="col s12">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="col s12">
                            <h4 class="center-align">Add new blocks</h4>
                        </div>
                        <div class="col s5">
                            <select name="pages_content_design_block_id"
                                    id="pages_content_design_block_id">
                                <option value="" disabled selected>Choose design block</option>
                                @foreach($design_blocks as $design_block)
                                    <option value="{{$design_block->id}}">{{$design_block->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s1">
                            <button class="btn-floating waves-effect waves-light green tooltipped" type="button" name="action"
                                    onclick="addPageDesignBlock(this)"
                            data-position="top"
                            data-tooltip="Add new design block">
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                        <div class="col s5">
                            <select name="pages_content_widget_id" id="pages_content_widget_id">
                                <option value="" disabled selected>Choose widget</option>
                                @foreach($widgets as $widget)
                                    <option value="{{$widget->id}}">{{$widget->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s1">
                            <button class="btn-floating waves-effect waves-light tooltipped green" type="button" name="action"
                                    onclick="addPageWidget(this)"
                            data-position="top"
                            data-tooltip="Add new widget">
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <h4 class="center-align">All content blocks</h4>
                        </div>
                        <div class="col s12">
                            @include('backend.parts.pages.page_edit.design_blocks', ['pages_current_design_blocks' => $page->design_blocks])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="/{{$page->url}}" target="_blank"
           class="btn-floating btn-large waves-effect waves-light blue tooltipped"
           data-position="left" data-tooltip="Go to page">
            <i class="material-icons">photo</i>
        </a>
        <button id="btn_update_page" class="btn-floating btn-large green tooltipped"
        data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
    @include('backend.common.modal_media')
@endsection

@push('after-scripts')
    <script src="/js/backend/jquery-ui.js"></script>
    <script src="/js/backend/ckeditor/ckeditor.js"></script>
    <script>
        function addPageDesignBlock(elem) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.design_block.add')}}',
                data: {page_id: {{$page->id}}, design_block_id: $('#pages_content_design_block_id').val()},
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Design block hasn\'t been added.', classes: 'red'});
                }
            });
        }

        function addPageWidget(elem) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.widget.add')}}',
                data: {page_id: {{$page->id}}, widget_id: $('#pages_content_widget_id').val()},
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function deletePageDesignBlock(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.design_block.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function (data) {
                    console.log(data);
                    $(elem).parent().parent().parent().remove();
                    M.toast({html: 'Success! Design block has been deleted', classes: 'green'});
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Design block hasn\'t been deleted', classes: 'red'});
                }
            });
        }

        function addPageChildrenDesignBlock(elem) {
            var id = $(elem).data('parent-id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.child_design_block.add')}}',
                data: {parent_design_block: id, design_block: $('#page_children_design_blocks_select_' + id).val()},
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Children design block hasn\'t been added.', classes: 'red'});
                }
            });
        }

        function updatePageDesignBlockContent(elem) {
            var status = null;
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function () {
                data += '&' + $(this).attr('name') + '=' + $('<textarea />').html(CKEDITOR.instances[$(this).attr('id')].getData()).text();
            });
            $.ajax({
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.page_content.update') !!}',
                data: data + '&locale_id={{$current_locale}}',
                success: function (data) {
                    console.log(data);
                    status = true;
                },
                error: function (data) {
                    console.log(data);
                    status = false;
                }
            });

            return status;
        }

        function updateCategoriesPagesDesignBlockContent(elem) {
            var status = null;
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function () {
                data += '&' + $(this).attr('name') + '=' + $('<textarea />').html(CKEDITOR.instances[$(this).attr('id')].getData()).text();
            });
            $.ajax({
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.category_page_content.update') !!}',
                data: data + '&locale_id={{$current_locale}}',
                success: function (data) {
                    console.log(data);
                    status = true;
                },
                error: function (data) {
                    console.log(data);
                    status = false;
                }
            });

            return status;
        }

        function deleteCategoriesPagesChildrenDesignBlock(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.category_page.design_block.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function (data) {
                    console.log(data);
                    $(elem).parent().parent().parent().remove();
                    M.toast({html: 'Success! Design block has been deleted', classes: 'green'});
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Design block hasn\'t been deleted', classes: 'red'});
                }
            });
        }

        function addCategoriesPagesChildrenDesignBlock(elem) {
            var id = $(elem).data('parent-id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.category_page.child_design_block.add')}}',
                data: {
                    parent_design_block: id,
                    design_block: $('#categories_pages_children_design_blocks_select_' + id).val()
                },
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Children design block hasn\'t been added.', classes: 'red'});
                }
            });
        }

        $(document).ready(function () {
            $(document).find('.wysiwyg-textarea').each(function () {
                if (!CKEDITOR.instances[$(this).attr('id')]) {
                    var editor = CKEDITOR.replace($(this).attr('id'));
                    var that = this;
                    editor.on('instanceReady', function () {
                        $(that).parent().find('label').eq(0).addClass('active');
                    });
                }
            });

            $('.tab').click(function () {
                window.location = window.location.origin + window.location.pathname + window.location.search + $(this).find('a').attr('href');
            });

            $('.collapsible').collapsible({
                onOpenStart: function (elem) {
                    if ($(elem).parent().is('[class*="sortable"]')) {
                        $(elem).parent().sortable('option', 'disabled', true);
                    }
                },
                onCloseEnd: function (elem) {
                    if ($(elem).parent().is('[class*="sortable"]')) {
                        $(elem).parent().sortable('option', 'disabled', false);
                    }
                }
            });

            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('#form_update_page_main').submit(function (e) {
                e.preventDefault();
                var status = null;
                $.ajax({
                    type: 'POST',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.page.update')}}',
                    data: {
                        id: {{$page->id}},
                        url: $('#page_url').val(),
                        title: $('#page_title').val(),
                        description: $('#page_description').val(),
                        keywords: $('#page_keywords').val(),
                        page_template_id: $('#page_template_id').val(),
                        locale_id: $('#locale_select_id').val(),
                        categories: $('#page_categories').val(),
                        _method: 'PUT'
                    },
                    success: function (data) {
                        console.log(data);
                        status = true;
                    },
                    error: function (data) {
                        console.log(data);
                        status = false;
                    },
                });

                return status;
            });

            $('#btn_update_page').click(function () {
                var is_success = true;
                $('.form_design_block').each(function () {
                    is_success = updatePageDesignBlockContent(this);
                    if(!is_success) {
                        M.toast({html: 'Error! Couldn\'t save design block', classes: 'red'});
                    }
                });
                $('.form_categories_design_blocks').each(function() {
                    is_success = updateCategoriesPagesDesignBlockContent(this);
                    if(!is_success) {
                        M.toast({html: 'Error! Couldn\'t save category excerpt design block', classes: 'red'});
                    }
                });
                is_success = $('#form_update_page_main').submit();
                if(!is_success) {
                    M.toast({html: 'Error! Couldn\'t save main or seo info', classes: 'red'});
                }

                if(is_success) {
                    M.toast({html: 'Success! Page has been updated.', classes: 'green'});
                    window.location.reload();
                }
            });

            $('.pages-sortable').sortable({
                stop: function (event, ui) {
                    $(ui.item).find('.wysiwyg-textarea').each(function () {
                        CKEDITOR.instances[$(this).attr('id')].destroy();
                        var editor = CKEDITOR.replace($(this).attr('id'));
                        var that = this;
                        editor.on('instanceReady', function () {
                            $(that).parent().find('label').eq(0).addClass('active');
                        });

                    });
                    var elements = $(ui.item).parent().children();
                    var order = [];
                    console.log(elements);
                    var length = elements.length;
                    for (i = 0; i < length; i++) {
                        if (!$(elements[i]).hasClass('ui-sortable-placeholder')) {
                            order.push({id: $(elements[i]).data('id'), order: (i + 1)});
                        }
                    }
                    console.log(order);
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('api.page.design_blocks.order.update')}}',
                        data: {order: order},
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });

            $('.categories-sortable').sortable({
                stop: function (event, ui) {
                    $(ui.item).find('.wysiwyg-textarea').each(function () {
                        CKEDITOR.instances[$(this).attr('id')].destroy();
                        var editor = CKEDITOR.replace($(this).attr('id'));
                        var that = this;
                        editor.on('instanceReady', function () {
                            $(that).parent().find('label').eq(0).addClass('active');
                        });

                    });
                    var elements = $(ui.item).parent().children();
                    var order = [];
                    console.log(elements);
                    var length = elements.length;
                    for (i = 0; i < length; i++) {
                        if (!$(elements[i]).hasClass('ui-sortable-placeholder')) {
                            order.push({id: $(elements[i]).data('id'), order: (i + 1)});
                        }
                    }
                    console.log(order);
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('api.category_page.design_blocks.order.update')}}',
                        data: {order: order},
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });

        });
    </script>
@endpush