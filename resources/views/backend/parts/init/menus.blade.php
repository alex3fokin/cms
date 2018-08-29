<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new menu</h3>
        <form method="POST" id="add_menu_form" onkeypress="return event.keyCode != 13;">
            <div class="input-field col s12">
                <label for="menu_title">Title</label>
                <input type="text" name="menu_title" id="menu_title">
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <div class="row">
            <div class="col s12">
                <h3 class="center-align">Menus</h3>
                <ul class="collapsible">
                    @foreach($menus as $menu)
                        <li>
                            <div class="collapsible-header">
                                <div class="left">
                                    {{$menu->title}}
                                </div>
                                <div class="right">
                                    <button class="btn-floating waves-effect waves-light red" type="button"
                                            data-id="{{$menu->id}}" onclick="deleteMenu(this)"><i
                                                class="material-icons">delete</i></button>
                                </div>
                            </div>
                            <div class="collapsible-body">
                                <div>
                                    <h4 class="center-align">Add new menu item</h4>
                                    <form method="POST" onkeypress="return event.keyCode != 13;">
                                        <div class="input-field col s6">
                                            <label for="menu_item_title">Title</label>
                                            <input type="text" name="menu_item_title" id="menu_item_title">
                                        </div>
                                        <div class="input-field col s6">
                                            <select id="menu_item_page_id">
                                                <option value="" selected disabled>Choose page to add</option>
                                                @foreach($pages as $page)
                                                    <option value="{{$page->id}}">{{$page->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn waves-effect waves-light" data-id="{{$menu->id}}" onclick="addMenuItem(this)" type="button" name="action">Add
                                            <i class="material-icons right">add</i>
                                        </button>
                                    </form>
                                    @include('backend.parts.init.parts.menus.menu_items', ['menu_items' => $menu->menu_items])
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        function deleteMenu(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
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
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function updateMenuItem(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu_item.update')}}',
                data: {
                    id: id,
                    title: $('#menu_title_'+id).val(),
                    page_id: $('#menu_item_page_id_'+id).val()
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
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
                }
            });
        }

        function addMenuItem(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.menu_item.add')}}',
                data: {
                    menu_id: id,
                    page_id: $('#menu_item_page_id').val(),
                    title: $('#menu_item_title').val()
                },
                success: function(data) {
                    console.log(data);
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function () {
            $('#add_menu_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.menu.add')}}',
                    data: {title: $('#menu_title').val()},
                    success:function(data) {
                        console.log(data);
                        window.location.reload();
                    },
                    error:function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush