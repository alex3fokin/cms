<div class="row">
    <ul class="collapsible">
        @foreach($pages as $page)
            <li>
                <div class="collapsible-header">{{$page->title}}</div>
                <div class="collapsible-body">
                    <div class="row">
                        <div class="col s12">
                            <ul class="collapsible">
                                @foreach($page->categories_pages as $category_page)
                                    <li>
                                        <div class="collapsible-header">{{$category_page->category->title}}</div>
                                        <div class="collapsible-body">
                                            @include('backend.parts.init.parts.pages_contents.categories_design_blocks', ['categories_current_design_blocks' => $category_page->design_blocks, 'is_sortable' => false])
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col s5">
                            <select name="pages_content_design_block_id"
                                    id="pages_content_design_block_id_{{$page->id}}">
                                <option value="" disabled selected>Choose design block</option>
                                @foreach($design_blocks as $design_block)
                                    <option value="{{$design_block->id}}">{{$design_block->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn waves-effect waves-light" type="button" name="action"
                                    data-id="{{$page->id}}" onclick="addPageDesignBlock(this)">Add design block
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                        <div class="col s5">
                            <select name="pages_content_widget_id" id="pages_content_widget_id_{{$page->id}}">
                                <option value="" disabled selected>Choose widget</option>
                                @foreach($widgets as $widget)
                                    <option value="{{$widget->id}}">{{$widget->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn waves-effect waves-light" type="button" name="action"
                                    data-id="{{$page->id}}" onclick="addPageWidget(this)">Add widget
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                        <div class="col s2">
                            <label>
                                <input type="checkbox" data-id="{{$page->id}}"
                                       class="page_published_checkbox" {{$page->published ? 'checked' : ''}}/>
                                <span>Published</span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                @include('backend.parts.init.parts.pages_contents.design_blocks', ['pages_current_design_blocks' => $page->design_blocks])
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@push('after-scripts')
    <script>
        function updateCategoriesPagesDesignBlockContent(elem) {
            console.log($(elem).parent().serialize());
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function () {
                data += '&' + $(this).attr('name') + '=' + $('<textarea />').html(CKEDITOR.instances[$(this).attr('id')].getData()).text();
            });
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.category_page_content.update') !!}',
                data: data + '&locale_id={{$current_locale}}',
                success: function (data) {
                    console.log(data);
                    M.toast({html: 'Data has been saved successfully', classes: 'green'});
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Data hasn\'t been saved', classes: 'red'});
                }
            });
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
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
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
                }
            });
        }

        function addPageDesignBlock(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.design_block.add')}}',
                data: {page_id: id, design_block_id: $('#pages_content_design_block_id_' + id).val()},
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function addPageWidget(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.widget.add')}}',
                data: {page_id: id, widget_id: $('#pages_content_widget_id_' + id).val()},
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function updatePageDesignBlockContent(elem) {
            console.log($(elem).parent().serialize());
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function () {
                data += '&' + $(this).attr('name') + '=' + $('<textarea />').html(CKEDITOR.instances[$(this).attr('id')].getData()).text();
            });
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.page_content.update') !!}',
                data: data + '&locale_id={{$current_locale}}',
                success: function (data) {
                    console.log(data);
                    M.toast({html: 'Data has been saved successfully', classes: 'green'});
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Data hasn\'t been saved', classes: 'red'});
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
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data);
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
                }
            });
        }

        $(document).ready(function () {
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

            $('.page_published_checkbox').change(function () {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.page.publicity.update')}}',
                    data: {id: $(this).data('id'), published: $(this).is(':checked'), _method: 'PUT'},
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush