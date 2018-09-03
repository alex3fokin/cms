<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new general info</h3>
        <form id="add_general_info_item" method="POST">
            <div class="input-field col s6">
                <label for="general_info_title">Title</label>
                <input type="text" name="general_info_title" id="general_info_title">
            </div>
            <div class="input-field col s6">
                <label for="general_info_value">Value</label>
                <input type="text" name="general_info_value" id="general_info_value">
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <h3 class="center-align">All general info</h3>
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="general-info-items">
            @foreach($general_infos as $general_info_item)
                <tr>
                    <td>
                        <div class="input-field col">
                            <label class="active" for="general_info_title_{{$general_info_item->id}}">Title</label>
                            <input type="text" name="general_info_title_{{$general_info_item->id}}" id="general_info_title_{{$general_info_item->id}}" value="{{$general_info_item->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col">
                            <label for="general_info_value_{{$general_info_item->id}}">Value</label>
                            <input type="text" name="general_info_value_{{$general_info_item->id}}" id="general_info_value_{{$general_info_item->id}}" value="{{$general_info_item->value}}">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green" data-id="{{$general_info_item->id}}" onclick="updateGeneralInfo(this)"><i class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red" data-id="{{$general_info_item->id}}" onclick="deleteGeneralInfo(this)"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('after-scripts')
    <script>
        function updateGeneralInfo(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.general_info.update')}}',
                data: {
                    id: id,
                    value: $('#general_info_value_'+id).val(),
                    title: $('#general_info_title_'+id).val(),
                    locale_id: $('#locale_select_id').val(),
                    _method: 'PUT'
                },
                success:function(data){
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                },
            });
        }

        function deleteGeneralInfo(elem) {
            var id = $(elem).data('id');
            var that = elem;
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
                        $(that).parent().parent().remove();
                    }
                },
                error:function(data){
                    console.log(data);
                },
            });
        }

        $(document).ready(function () {
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
                        data = data.general_info;
                        $('#general-info-items').append('<tr>\n' +
                            '                            <td>\n' +
                            '                                <div class="input-field col">\n' +
                            '                                    <label class="active" for="general_info_title_'+data.id+'">Title</label>\n' +
                            '                                    <input class="active" type="text" name="general_info_title_'+data.id+'" id="general_info_title_'+data.id+'" value="'+data.title+'">\n' +
                            '                                </div>\n' +
                            '                            </td>\n' +
                            '                            <td>\n' +
                            '                                <div class="input-field col">\n' +
                            '                                    <label class="active" for="general_info_value_'+data.id+'">Value</label>\n' +
                            '                                    <input type="text" name="general_info_value_'+data.id+'" id="general_info_value_'+data.id+'" value="'+data.value+'">\n' +
                            '                                </div>\n' +
                            '                            </td>\n' +
                            '                            <td>\n' +
                            '                                <button class="btn-floating waves-effect waves-light green" data-id="'+data.id+'" onclick="updateGeneralInfo(this)"><i class="material-icons">save</i></button>\n' +
                            '                                <button class="btn-floating waves-effect waves-light red" data-id="'+data.id+'" onclick="deleteGeneralInfo(this)"><i class="material-icons">delete</i></button>\n' +
                            '                            </td>\n' +
                            '                        </tr>');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                $(this).find('input').val('');
            });
        });
    </script>
@endpush