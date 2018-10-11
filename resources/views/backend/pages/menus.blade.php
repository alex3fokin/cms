@extends('backend.layouts.index')

@section('content')
    <div>
        <h1 class="center-align">Menus</h1>
        <table class="highlight" id="menus_table">
            <tr>
                <th>Name</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($menus as $menu)
                <tr>
                    <td>{{$menu->title}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.menu.edit', $menu->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit menu">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete menu"
                           data-id="{{$menu->id}}"
                           onclick="openConfirmModal(this, 'deleteMenu')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new menu" data-target="modal_create_menu">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Menu Modal -->
    <div id="modal_create_menu" class="modal">
        <div class="modal-content">
            <h4>Creating new menu</h4>
            <div class="row">
                <form id="add_menu" onkeypress="return event.keyCode != 13;" class="col s12">
                    <div class="input-field col s12">
                        <label for="menu_title">Title</label>
                        <input type="text" name="menu_title" id="menu_title">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_menu" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

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
                    $(elem).parent().parent().remove();
                    M.toast({html: 'Success! Menu has been deleted', classes: 'green'});
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Menu hasn\'t been deleted', classes: 'red'});
                }
            });
        }

        $(document).ready(function() {
            $('#add_menu').submit(function(e) {
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
                        menu = data.menu;
                        M.toast({html: 'Success! Menu has been created', classes: 'green'});
                        $('#menus_table').append('<tr>\n' +
                            '                    <td>'+menu.title+'</td>\n' +
                            '                    <td class="right">\n' +
                            '                        <a href="/admin/menus/edit/'+menu.id+'"\n' +
                            '                           class="btn btn-floating waves-effect waves-light orange tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Edit menu">\n' +
                            '                            <i class="material-icons">edit</i>\n' +
                            '                        </a>\n' +
                            '                        <a class="btn btn-floating waves-effect waves-light red tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Delete menu"\n' +
                            '                           data-id="'+menu.id+'"\n' +
                            '                           onclick="openConfirmModal(this, \'deleteMenu\')">\n' +
                            '                            <i class="material-icons">delete</i>\n' +
                            '                        </a>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                    },
                    error:function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Menu hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
            });
        });
    </script>
@endpush