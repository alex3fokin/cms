@extends('backend.layouts.index')

@section('content')
    <div class="mb-5">
        <h1 class="center-align">General info</h1>
        <table class="highlight" id="general_info_table">
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($general_infos as $general_info)
                <tr>
                    <td>{{$general_info->title}}</td>
                    <td>{{$general_info->value}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.general_info.edit', $general_info->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit general info item">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete general info item"
                           data-id="{{$general_info->id}}"
                           onclick="openConfirmModal(this, 'deleteGeneralInfo')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new general info item" data-target="modal_create_general_info">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Category Modal -->
    <div id="modal_create_general_info" class="modal">
        <div class="modal-content">
            <h4>Creating new general info item</h4>
            <div class="row">
                <form id="add_general_info_item" method="POST">
                    <div class="input-field col s12">
                        <label for="general_info_title">Title</label>
                        <input type="text" name="general_info_title" id="general_info_title">
                    </div>
                    <div class="input-field col s12">
                        <label for="general_info_value">Value</label>
                        <input type="text" name="general_info_value" id="general_info_value">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_general_info_item" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function deleteGeneralInfo(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.general_info.delete')}}',
                data: {id: id,  _method: 'DELETE'},
                success:function(data){
                    data = data.status;
                    if(data) {
                        $(elem).parent().parent().remove();
                        M.toast({html: 'Success! General info item has been deleted', classes: 'green'});
                    }
                },
                error:function(data){
                    console.log(data);
                    M.toast({html: 'Error! General info item hasn\'t been deleted', classes: 'red'});
                },
            });
        }

        $(document).ready(function() {
            $('#add_general_info_item').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('api.general_info.add')}}',
                    data: {
                        value: $('#general_info_value').val(),
                        title: $('#general_info_title').val()
                    },
                    success:function(data){
                        console.log(data);
                        general_info = data.general_info;
                        M.toast({html: 'Success! General info item has been created', classes: 'green'});
                        $('#general_info_table').append('<tr>\n' +
                            '                    <td>'+general_info.title+'</td>\n' +
                            '                    <td>'+general_info.value+'</td>\n' +
                            '                    <td class="right">\n' +
                            '                        <a href="/dashboard/general_info/edit/'+general_info.id+'"\n' +
                            '                           class="btn btn-floating waves-effect waves-light orange tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Edit general info item">\n' +
                            '                            <i class="material-icons">edit</i>\n' +
                            '                        </a>\n' +
                            '                        <a class="btn btn-floating waves-effect waves-light red tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Delete general info item"\n' +
                            '                           data-id="'+general_info.id+'"\n' +
                            '                           onclick="openConfirmModal(this, \'deleteGeneralInfo\')">\n' +
                            '                            <i class="material-icons">delete</i>\n' +
                            '                        </a>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! General info item hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
            });
        });
    </script>
@endpush