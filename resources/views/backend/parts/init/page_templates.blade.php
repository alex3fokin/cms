<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new page template info</h3>
        <form id="add_page_template" method="POST">
            <div class="input-field col s6">
                <label for="page_template_title">Title</label>
                <input type="text" name="page_template_title" id="page_template_title">
            </div>
            <div class="input-field col s6">
                <label for="page_template_view">View</label>
                <input type="text" name="page_template_view" id="page_template_view">
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <h3 class="center-align">All page templates</h3>
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>View</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="page_templates_info">
            @foreach($page_templates as $page_template)
                <tr>
                    <td>
                        <div class="input-field col s12">
                            <label class="active" for="page_template_title_{{$page_template->id}}">Title</label>
                            <input type="text" name="page_template_title_{{$page_template->id}}" id="page_template_title_{{$page_template->id}}" value="{{$page_template->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <label for="page_template_view_{{$page_template->id}}">View</label>
                            <input type="text" name="page_template_view_{{$page_template->id}}" id="page_template_view_{{$page_template->id}}" value="{{$page_template->view}}">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green" data-id="{{$page_template->id}}" onclick="updatePageTemplate(this)"><i class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red" data-id="{{$page_template->id}}" onclick="deletePageTemplate(this)"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('after-scripts')
    <script>
        function updatePageTemplate(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page_template.update')}}',
                data: {id: id, view: $('#page_template_view_'+id).val(), title: $('#page_template_title_'+id).val(), _method: 'PUT'},
                success:function(data){
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                },
            });
        }

        function deletePageTemplate(elem) {
            var id = $(elem).data('id');
            var that = elem;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page_template.delete')}}',
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
            $('#add_page_template').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('api.page_template.add')}}',
                    data: {title: $('#page_template_title').val(), view: $('#page_template_view').val()},
                    success:function(data){
                        data = data.page_template;
                        $('#page_templates_info').append('<tr>\n' +
                            '                            <td>\n' +
                            '                                <div class="input-field col s12">\n' +
                            '                                    <label class="active" for="page_template_title_'+data.id+'">Title</label>\n' +
                            '                                    <input class="active" type="text" name="page_template_title_'+data.id+'" id="page_template_title_'+data.id+'" value="'+data.title+'">\n' +
                            '                                </div>\n' +
                            '                            </td>\n' +
                            '                            <td>\n' +
                            '                                <div class="input-field col s12">\n' +
                            '                                    <label class="active" for="page_template_view_'+data.id+'">Value</label>\n' +
                            '                                    <input type="text" name="page_template_view_'+data.id+'" id="page_template_view_'+data.id+'" value="'+data.view+'">\n' +
                            '                                </div>\n' +
                            '                            </td>\n' +
                            '                            <td>\n' +
                            '                                <button class="btn-floating waves-effect waves-light green" data-id="'+data.id+'" onclick="updatePageTemplate(this)"><i class="material-icons">save</i></button>\n' +
                            '                                <button class="btn-floating waves-effect waves-light red" data-id="'+data.id+'" onclick="deletePageTemplate(this)"><i class="material-icons">delete</i></button>\n' +
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