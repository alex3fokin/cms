@extends('backend.layouts.index')

@section('content')
    <div class="mb-5">
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
        <h1 class="center-align">Edit menu</h1>
        <div class="row">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#main_tab">Main</a></li>
                <li class="tab"><a href="#items_tab">Items</a></li>
            </ul>
        </div>
        <div id="main_tab">
            <div class="row">
                <form id="form_update_menu" onkeypress="return event.keyCode != 13;" class="col s12">
                    <div class="input-field col s12">
                        <label class="active" for="menu_title">Title</label>
                        <input type="text" name="menu_title" id="menu_title" value="{{$menu->title}}">
                    </div>
                </form>
            </div>
        </div>
        <div id="items_tab">
            <div class="row">
                <div class="col s12">
                    <form method="POST" onkeypress="return event.keyCode != 13;">
                        <div class="input-field col s5">
                            <label for="menu_item_title">Title</label>
                            <input type="text" name="menu_item_title" id="menu_item_title">
                        </div>
                        <div class="input-field col s6">
                            <select id="menu_item_page_id">
                                <option value="" selected disabled>Choose page\category to add</option>
                                <optgroup label="Pages">
                                    @foreach($pages as $page)
                                        <option value="page_{{$page->id}}">{{$page->title}}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Categories">
                                    @foreach($categories as $category)
                                        <option value="category_{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="input-field col s1">
                            <button class="btn-floating waves-effect waves-light green tooltipped"
                                   onclick="addMenuItem(this)" type="button" name="action"
                                    data-position="top" data-tooltip="Add new menu item">
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col s12">
                    @include('backend.parts.menus.menu_edit.menu_items', ['menu_items' => $menu->translatedMenuItems(($current_locale !== $default_language) ? $current_locale : null)])
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_menu" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script src="/js/backend/jquery-ui.js"></script>
    <script>
        function addMenuItem(elem) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu_item.add')}}',
                data: {
                    menu_id: {{$menu->id}},
                    page_id: $('#menu_item_page_id').val(),
                    title: $('#menu_item_title').val()
                },
                success: function(data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Menu item hasn\'t been added', classes: 'red'});
                }
            });
        }

        function addChildMenuItem(elem) {
            var id = $(elem).data('parent-id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.child_menu_item.add')}}',
                data: {
                    menu_id: {{$menu->id}},
                    parent_menu: id,
                    page_id: $('#child_menu_item_page_id_'+id).val(),
                    title: $('#child_menu_item_title_'+id).val()
                },
                success: function(data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Menu item hasn\'t been added', classes: 'red'});
                }
            });
        }

        function deleteMenuItem(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu_item.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function(data) {
                    console.log(data);
                    $(elem).parent().parent().parent().remove();
                    M.toast({html: 'Success! Menu item has been deleted', classes: 'green'});
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Menu item hasn\'t been deleted', classes: 'red'});
                }
            });
        }

        function updateMenuItem(elem) {
            var id = $(elem).data('id');
            var status = null;
            $.ajax({
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu_item.update')}}',
                data: {
                    id: id,
                    title: $('#menu_title_'+id).val(),
                    page_id: $('#menu_item_page_id_'+id).val(),
                    locale_id: $('#locale_select_id').val(),
                },
                success: function(data) {
                    console.log(data);
                    status = true;
                },
                error: function(data) {
                    console.log(data);
                    status = false;
                }
            });

            return status;
        }

        $(document).ready(function () {
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('.tab').click(function () {
                window.location = window.location.origin + window.location.pathname + window.location.search + $(this).find('a').attr('href');
            });

            $('.menu_items-sortable').sortable({
                stop: function( event, ui ) {
                    var elements = $(ui.item).parent().children();
                    var order = [];
                    console.log(elements);
                    var length = elements.length;
                    for(i = 0; i < length; i++) {
                        if(!$(elements[i]).hasClass('ui-sortable-placeholder')) {
                            order.push({id: $(elements[i]).data('id'), order: (i+1)});
                        }
                    }
                    console.log(order);
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('api.menu_item.order.update')}}',
                        data: {order: order},
                        success: function (data) {
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });

            $('#form_update_menu').submit(function(e) {
                e.preventDefault();
                var status = null;
                $.ajax({
                    type: 'POST',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.menu.update')}}',
                    data: {id: {{$menu->id}},title: $('#menu_title').val(), _method: 'PUT'},
                    success:function(data) {
                        console.log(data);
                        status = true;
                    },
                    error:function(data) {
                        console.log(data);
                        status = false;
                    }
                });

                return status;
            });

            $('#btn_update_menu').click(function () {
                var is_success = true;
                is_success = $('#form_update_menu').submit();
                if(!is_success) {
                    M.toast({html: 'Error! Couldn\'t save main info', classes: 'red'});
                }
                $('.form_menu_item').each(function () {
                    is_success = updateMenuItem(this);
                    if(!is_success) {
                        M.toast({html: 'Error! Couldn\'t save menu item', classes: 'red'});
                    }
                });

                if(is_success) {
                    M.toast({html: 'Success! Menu has been updated.', classes: 'green'});
                }
            });
        });
    </script>
@endpush