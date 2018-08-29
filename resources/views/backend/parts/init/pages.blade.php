<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new page</h3>
        <form id="add_page" onkeypress="return event.keyCode != 13;" class="col s12">
            <h5>Main info</h5>
            <div class="input-field col s6">
                <label for="page_title">Title</label>
                <input type="text" name="page_title" id="page_title">
            </div>
            <div class="input-field col s6">
                <label for="page_url">URL</label>
                <input type="text" name="page_url" id="page_url">
            </div>
            <h5>SEO info</h5>
            <div class="input-field col s6">
                <label for="page_description">Description</label>
                <textarea id="page_description" class="materialize-textarea" name="page_description"></textarea>
            </div>
            <div class="col s6">
                <label class="active" for="page_keywords">Keywords</label>
                <input type="text" name="page_keywords" id="page_keywords" data-role="tagsinput">
            </div>
            <h5 class="col s12">Choose page template</h5>
            <div class="input-field col s12">
                <select name="page_template_id" id="page_template_id">
                    <option value="" disabled selected>Choose page template</option>
                    @foreach($page_templates as $page_template)
                        <option value="{{$page_template->id}}">{{$page_template->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Add
                    <i class="material-icons right">add</i>
                </button>
            </div>
        </form>
        <h3 class="center-align">Set home page</h3>
        <div class="row">
            <div class="col s12">
                <select id="default_home_page">
                    <option value="" selected disabled>Choose page</option>
                    @foreach($pages as $page)
                        <option value="{{$page->title}}" {{$default_home_page === $page->title ? 'selected' : ''}}>{{$page->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="button" name="action" onclick="updateHomePage()">Set
                    <i class="material-icons right">done</i>
                </button>
            </div>
        </div>
        <h3 class="center-align">All pages</h3>
        <table class="highlight">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Description</th>
                    <th>Keywords</th>
                    <th>Page template</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="all_pages_table">
            @foreach($pages as $page_item)
                <tr>
                    <td>
                        <div class="input-field col">
                            <label class="active" for="page_title_{{$page_item->id}}">Title</label>
                            <input type="text" name="page_title_{{$page_item->id}}" id="page_title_{{$page_item->id}}" value="{{$page_item->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col">
                            <label for="page_url_{{$page_item->id}}">Value</label>
                            <input type="text" name="page_url_{{$page_item->id}}" id="page_url_{{$page_item->id}}" value="{{$page_item->url}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <label for="page_description_{{$page_item->id}}">Description</label>
                            <textarea id="page_description_{{$page_item->id}}" name="page_description_{{$page_item->id}}" class="materialize-textarea">{{$page_item->seo->description}}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="col s12">
                            <label class="active" for="page_keywords_{{$page_item->id}}">Keywords</label>
                            <input type="text" name="page_keywords_{{$page_item->id}}" id="page_keywords_{{$page_item->id}}" data-role="tagsinput" value="{{$page_item->seo->keywords}}">
                        </div>
                    </td>
                    <td>
                        <select name="page_template_id_{{$page_item->id}}" id="page_template_id_{{$page_item->id}}">
                            <option value="" disabled selected>Choose page template</option>
                            @foreach($page_templates as $page_template)
                                <option value="{{$page_template->id}}" {{$page_template->id === $page_item->page_template->id ? "selected" : ""}}>{{$page_template->title}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green" data-id="{{$page_item->id}}" onclick="updatePage(this)"><i class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red" data-id="{{$page_item->id}}" onclick="deletePage(this)"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('after-scripts')
    <script>
        var page_templates = {!! json_encode($page_templates) !!};
        function updateHomePage() {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.default.home_page.update')}}',
                data: {default_home_page: $('#default_home_page').val(), _method: 'PUT'},
                success:function(data){
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                },
            });
        }
        function updatePage(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.update')}}',
                data: {id: id, url: $('#page_url_'+id).val(), title: $('#page_title_'+id).val(), description: $('#page_description_'+id).val(), keywords: $('#page_keywords_'+id).val(), page_template_id: $('#page_template_id_'+id).val(), _method: 'PUT'},
                success:function(data){
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                },
            });
        }

        function deletePage(elem) {
            var id = $(elem).data('id');
            var that = elem;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.page.delete')}}',
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
            $('#add_page').submit(function (e) {
                e.preventDefault();
                var data = {
                    title: $('#page_title').val(),
                    url: $('#page_url').val(),
                    description: $('#page_description').val(),
                    keywords: $('#page_keywords').val(),
                    page_template_id: $('#page_template_id').val()
                };
                $.ajax({
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('api.page.add')}}',
                    data: data,
                    success:function(data){
                        console.log(data);
                        data = data.page;
                        var page_template_options = '';
                        page_templates.forEach(function(option) {
                            var selected = (parseInt(option.id) === parseInt(data.page_template_id)) ? 'selected' : '';
                            page_template_options += '<option value="'+option.id+'" '+selected+'>'+option.title+'</option>';
                        });
                        $('#all_pages_table').append('<tr>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="page_title_'+data.id+'">Title</label>\n' +
                            '                            <input type="text" name="page_title_'+data.id+'" id="page_title_'+data.id+'" value="'+data.title+'">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="page_url_'+data.id+'">Value</label>\n' +
                            '                            <input type="text" name="page_url_'+data.id+'" id="page_url_'+data.id+'" value="'+data.url+'">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col s12">\n' +
                            '                            <label class="active" for="page_description_'+data.id+'">Description</label>\n' +
                            '                            <textarea id="page_description_'+data.id+'" name="page_description_'+data.id+'" class="materialize-textarea">'+data.seo.description+'</textarea>\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="col s12">\n' +
                            '                            <label class="active" for="page_keywords_'+data.id+'">Keywords</label>\n' +
                            '                            <input type="text" name="page_keywords_'+data.id+'" id="page_keywords_'+data.id+'" data-role="tagsinput" value="'+data.seo.keywords+'">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <select name="page_template_id_'+data.id+'" id="page_template_id_'+data.id+'">\n' +
                            '                            <option value="" disabled selected>Choose page template</option>\n' +page_template_options+
                            '                        </select>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <button class="btn-floating waves-effect waves-light green" data-id="'+data.id+'" onclick="updatePage(this)"><i class="material-icons">save</i></button>\n' +
                            '                        <button class="btn-floating waves-effect waves-light red" data-id="'+data.id+'" onclick="deletePage(this)"><i class="material-icons">delete</i></button>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                        $('#page_keywords_' + data.id).tagsinput();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                $(this).find('input').val('');
                $(this).find('textarea').val('');
                $('#page_keywords').tagsinput('removeAll');
            });
        });
    </script>
@endpush