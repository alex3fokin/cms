<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new widgets</h3>
        <form id="add_widget" onkeypress="return event.keyCode != 13;">
            <div class="input-field col s12">
                <label for="widget_title">Title</label>
                <input type="text" name="widget_title" id="widget_title">
            </div>
            <div class="col s12">
                <label class="active" for="widget_design_blocks">Design blocks</label>
                <input type="text" name="widget_design_blocks" id="widget_design_blocks">
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <h3 class="center-align">All widgets</h3>
        <table class="highlight">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="widgets_table">
            @foreach($widgets as $widget)
                <tr>
                    <td>
                        <div class="input-field col">
                            <label class="active" for="widget_title_{{$widget->id}}">Title</label>
                            <input type="text" name="widget_title_{{$widget->id}}" id="widget_title_{{$widget->id}}" value="{{$widget->title}}">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green"
                                data-id="{{$widget->id}}" onclick="updateWidget(this)"><i
                                    class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red"
                                data-id="{{$widget->id}}" onclick="deleteWidget(this)"><i
                                    class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('after-scripts')
    <script>
        var available_design_blocks = {!! json_encode($available_design_blocks) !!};

        function updateWidget(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.update')}}',
                data: {id: id, title: $('#widget_title_'+id).val(), _method: 'PUT'},
                success:function(data){
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                },
            });
        }

        function deleteWidget(elem) {
            var id = $(elem).data('id');
            var that = elem;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.delete')}}',
                data: {id: id, _method: 'DELETE'},
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
            $('input[id^="widget_design_blocks"]').tagsinput({
                allowDuplicates: true
            });
            $('input[id^="widget_design_blocks"]').on('itemAdded', function (event) {
                if ($.inArray(event.item, available_design_blocks) === -1) {
                    $(this).tagsinput('remove', event.item);
                }
            });
            $('input[id^="widget_design_blocks"]').on('itemRemoved', function (event) {
                if ($.inArray(event.item, available_design_blocks) !== -1) {
                    var tags = $(this).val().split(',');
                    var tags_length = tags.length;
                    var count = 0;
                    for (var i = 0; i < tags_length; i++) {
                        if (tags[i] === event.item) {
                            count++;
                        }
                    }
                    for (var i = 0; i < count; i++) {
                        $(this).tagsinput('remove', event.item);
                        $(this).tagsinput('add', event.item);
                    }
                }
            });

            $('#add_widget').submit(function (e) {
                e.preventDefault();
                var data = {
                    name: $('#widget_name').val(),
                    title: $('#widget_title').val(),
                    design_blocks: $('#widget_design_blocks').val().split(',')
                };
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.widget.add')}}',
                    data: data,
                    success: function(data) {
                        console.log(data);
                        data = data.widget;
                        $('#widgets_table').append('<tr>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="widget_title_'+data.id+'">Title</label>\n' +
                            '                            <input type="text" name="widget_title_'+data.id+'" id="widget_title_'+data.id+'" value="'+data.title+'">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <button class="btn-floating waves-effect waves-light green"\n' +
                            '                                data-id="'+data.id+'" onclick="updateWidget(this)"><i\n' +
                            '                                    class="material-icons">save</i></button>\n' +
                            '                        <button class="btn-floating waves-effect waves-light red"\n' +
                            '                                data-id="'+data.id+'" onclick="deleteWidget(this)"><i\n' +
                            '                                    class="material-icons">delete</i></button>\n' +
                            '                    </td>\n' +
                            '                </tr>');

                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
                $(this).find('input').val('');
                $('#widget_design_blocks').tagsinput('removeAll');
            });
        });
    </script>
@endpush