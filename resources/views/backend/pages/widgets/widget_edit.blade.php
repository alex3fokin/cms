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
        <h1 class="center-align">Edit Widget</h1>
        <div class="row">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#main_tab">Main</a></li>
                <li class="tab"><a href="#content_tab">Content</a></li>
            </ul>
        </div>
        <div id="main_tab">
            <div class="row">
                <form id="form_update_widget" onkeypress="return event.keyCode != 13;" class="col s12">
                    <div class="input-field col s12">
                        <label class="active" for="widget_title">Title</label>
                        <input type="text" name="widget_title" id="widget_title" value="{{$widget->title}}">
                    </div>
                    <div class="input-field col s12">
                        <label for="widget_design_blocks" class="active">Choose excerpt design blocks</label>
                        <select type="text" name="widget_design_blocks" id="widget_design_blocks" multiple>
                            <option value="" selected disabled></option>
                            @php
                                $widget_design_blocks = [];
                                foreach($widget->design_blocks as $widget_design_block) {
                                    $widget_design_blocks[] = $widget_design_block->design_block->title;
                                }
                            @endphp
                            @foreach($design_blocks as $design_block)
                                <option value="{{$design_block->title}}" {{in_array($design_block->title, $widget_design_blocks) ? 'selected' : ''}}>{{$design_block->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div id="content_tab">
            <div class="row">
                <div class="col s12">
                    @include('backend.parts.widgets.widget_edit.design_blocks', ['widgets_current_design_blocks' => $widget->design_blocks, 'is_sortable' => true, 'can_delete' => false])
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_widget" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script src="/js/backend/jquery-ui.js"></script>
    <script src="/js/backend/ckeditor/ckeditor.js"></script>
    <script>

        function updateWidgetDesignBlockContent(elem) {
            console.log($(elem).parent().serialize());
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function () {
                data += '&' + $(this).attr('name') + '=' + $('<textarea />').html(CKEDITOR.instances[$(this).attr('id')].getData()).text();
            });
            var status = null;
            $.ajax({
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.widget_content.update') !!}',
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

        function deleteWidgetChildrenDesignBlock(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.design_block.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function (data) {
                    console.log(data);
                    $(elem).parent().parent().parent().remove();
                    M.toast({html: 'Success! Design block has been deleted', classes: 'green'});
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function addWidgetChildrenDesignBlock(elem) {
            var id = $(elem).data('parent-id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.design_block.add')}}',
                data: {parent_design_block: id, design_block: $('#widget_children_design_blocks_select_' + id).val()},
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
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('.tab').click(function () {
                window.location = window.location.origin + window.location.pathname + window.location.search + $(this).find('a').attr('href');
            });

            $('.widget-sortable').sortable({
                stop: function (event, ui) {
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
                        url: '{{route('api.widget.design_blocks.order.update')}}',
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

            $('#form_update_widget').submit(function (e) {
                e.preventDefault();
                var status = null;
                $.ajax({
                    type: 'POST',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.widget.update')}}',
                    data: {id: {{$widget->id}}, title: $('#widget_title').val(), _method: 'PUT'},
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

            $('#btn_update_widget').click(function () {
                var is_success = true;
                is_success = $('#form_update_widget').submit();
                if (!is_success) {
                    M.toast({html: 'Error! Couldn\'t save main info', classes: 'red'});
                }
                $('.form_design_block').each(function () {
                    is_success = updateWidgetDesignBlockContent(this);
                    if (!is_success) {
                        M.toast({html: 'Error! Couldn\'t save design block', classes: 'red'});
                    }
                });

                if (is_success) {
                    M.toast({html: 'Success! Page has been updated.', classes: 'green'});
                }
            });
        });
    </script>
@endpush