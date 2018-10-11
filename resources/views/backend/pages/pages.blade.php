@extends('backend.layouts.index')

@section('content')
    <div>
        <h1 class="center-align">Pages & Templates</h1>
        <ul class="collapsible">
            <li class="active">
                <div class="collapsible-header justify-content-between">
                    <div><i class="material-icons va-b">file_copy</i>Templates</div>
                    <div>
                        <button class="btn btn-floating waves-effect waves-light green tooltipped modal-trigger"
                                data-position="left" data-tooltip="Create new template"
                                data-target="modal_create_template">
                            <i class="material-icons va-b">add</i>
                        </button>
                    </div>
                </div>
                <div class="collapsible-body">
                    <table class="highlight" id="page_templates_table">
                        <tr>
                            <th>Name</th>
                            <th class="right">Actions</th>
                        </tr>
                        @foreach($page_templates as $page_template)
                            <tr>
                                <td>{{$page_template->title}}</td>
                                <td class="right">
                                    <a href="{{route('dashboard.pages.template.edit', $page_template->id)}}"
                                       class="btn btn-floating waves-effect waves-light orange tooltipped"
                                       data-position="top" data-tooltip="Edit page template">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a class="btn btn-floating waves-effect waves-light red tooltipped"
                                       data-position="top" data-tooltip="Delete page template"
                                       data-id="{{$page_template->id}}"
                                       onclick="openConfirmModal(this, 'deletePageTemplate')">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </li>
            <li>
                <div class="collapsible-header justify-content-between">
                    <div>
                        <i class="material-icons va-b">insert_drive_file</i>Pages
                    </div>
                    <div>
                        <button class="btn btn-floating waves-effect waves-light green tooltipped modal-trigger" data-position="left"
                                data-tooltip="Create new page"
                                data-target="modal_create_page">
                            <i class="material-icons va-b">add</i>
                        </button>
                    </div>
                </div>
                <div class="collapsible-body">
                    <form id="update_home_page">
                        <div class="row">
                            <div class="input-field col s2">
                                <p>
                                    <b>Home page:</b>
                                </p>
                            </div>
                            <div class="input-field col s9">
                                <select id="default_home_page">
                                    <option value="" selected disabled>Choose page</option>
                                    @foreach($pages as $page)
                                        <option value="{{$page->title}}" {{$default_home_page === $page->title ? 'selected' : ''}}>{{$page->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field col s1">
                                <button class="btn-floating waves-effect waves-light green right" type="submit">
                                    <i class="material-icons right">save</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="collapsible">
                        @php
                            $categories_pages = $pages->groupBy('category_title');
                        @endphp
                        @foreach($categories_pages as $category => $pages)
                            <li>
                                <div class="collapsible-header">
                                    {{ $category ? $category : 'without category' }}
                                </div>
                                <div class="collapsible-body">
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Published</th>
                                            <th class="right">Actions</th>
                                        </tr>
                                        @foreach($pages as $page)
                                            <tr>
                                                <td>{{$page->title}}</td>
                                                <td>
                                                    <div class="switch">
                                                        <label>
                                                            <input type="checkbox" class="published"
                                                                   data-id="{{$page->id}}"
                                                                   data-page="{{$page->title}}"
                                                                    {{$page->published ? 'checked' : ''}}>
                                                            <span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="right">
                                                    <a href="/{{$page->url}}" target="_blank"
                                                    class="btn-floating waves-effect waves-light blue tooltipped"
                                                    data-position="top" data-tooltip="Go to page">
                                                        <i class="material-icons">photo</i>
                                                    </a>
                                                    <a href="{{route('dashboard.page.edit', $page->id)}}"
                                                       class="btn btn-floating waves-effect waves-light orange tooltipped"
                                                       data-position="top" data-tooltip="Edit page">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a class="btn btn-floating waves-effect waves-light red tooltipped"
                                                       data-position="top" data-tooltip="Delete page"
                                                       data-id="{{$page->id}}"
                                                       onclick="openConfirmModal(this, 'deletePage')">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- Create New Page Template Modal -->
    <div id="modal_create_template" class="modal">
        <div class="modal-content">
            <h4>Creating new template</h4>
            <div class="row">
                <form id="add_page_template" method="POST">
                    <div class="input-field col s6">
                        <label for="page_template_title">Title</label>
                        <input type="text" name="page_template_title" id="page_template_title">
                    </div>
                    <div class="input-field col s6">
                        <label for="page_template_view">View</label>
                        <input type="text" name="page_template_view" id="page_template_view">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_page_template" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
    <!-- Create New Page Modal -->
    <div id="modal_create_page" class="modal">
        <div class="modal-content">
            <h4>Creating new page</h4>
            <div class="row">
                <form id="add_page" onkeypress="return event.keyCode != 13;" class="col s12">
                    <h5>Main</h5>
                    <div class="input-field col s6">
                        <label for="page_title">Title</label>
                        <input type="text" name="page_title" id="page_title">
                    </div>
                    <div class="input-field col s6">
                        <label for="page_url">URL</label>
                        <input type="text" name="page_url" id="page_url">
                    </div>
                    <div class="input-field col s12">
                        <label for="page_template_id" class="active">Choose page template</label>
                        <select name="page_template_id" id="page_template_id">
                            <option value="" disabled selected></option>
                            @foreach($page_templates as $page_template)
                                <option value="{{$page_template->id}}">{{$page_template->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label for="page_categories" class="active">Choose categories</label>
                        <select name="page_categories" id="page_categories" multiple>
                            <option value="" disabled selected></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h5>SEO</h5>
                    <div class="input-field col s6">
                        <label for="page_description">Description</label>
                        <textarea id="page_description" class="materialize-textarea" name="page_description"></textarea>
                    </div>
                    <div class="input-field col s6">
                        <label for="page_keywords">Keywords</label>
                        <textarea name="page_keywords" id="page_keywords" class="materialize-textarea"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_page" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
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
                success: function (data) {
                    data = data.status;
                    if (data) {
                        $(that).parent().parent().remove();
                        M.toast({html: 'Success! Page template has been deleted.', classes: 'green'});
                    }
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Page template hasn\'t been deleted.', classes: 'red'});
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
                        M.toast({html: 'Success! Page has been deleted', classes: 'green'});
                    }
                },
                error:function(data){
                    console.log(data);
                    M.toast({html: 'Error! Page hasn\'t been deleted', classes: 'red'});
                },
            });
        }

        $(document).ready(function () {

            $('#add_page_template').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.page_template.add')}}',
                    data: {title: $('#page_template_title').val(), view: $('#page_template_view').val()},
                    success: function (data) {
                        console.log(data);
                        var page_template = data.page_template;
                        $('#page_templates_table').append('<tr>\n' +
                            '                                <td>' + page_template.title + '</td>\n' +
                            '                                <td class="right">\n' +
                            '                                    <a href="/admin/pages/templates/edit/' + page_template.id + '" class="btn btn-floating waves-effect waves-light orange tooltipped" data-position="top" data-tooltip="Edit page template">\n' +
                            '                                       <i class="material-icons">edit</i>\n' +
                            '                                    </a>\n' +
                            '                                    <a class="btn btn-floating waves-effect waves-light red tooltipped" data-position="top" data-tooltip="Delete page template" data-id="' + page_template.id + '" onclick="openConfirmModal(this, \'deletePageTemplate\')">\n' +
                            '                                        <i class="material-icons">delete</i>\n' +
                            '                                    </a>\n' +
                            '                                </td>\n' +
                            '                            </tr>');
                        M.toast({html: 'Success! Page template has been created.', classes: 'green'});

                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Page template hasn\'t been created.', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
            });

            $('#update_home_page').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.default.home_page.update')}}',
                    data: {default_home_page: $('#default_home_page').val(), _method: 'PUT'},
                    success: function (data) {
                        console.log(data);
                        M.toast({html: 'Success! Home page has been changed', classes: 'green'});
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Home page hasn\'t been re-set', classes: 'red'});
                    },
                });
            });

            $('.published').change(function () {
                var page = $(this).data('page');
                var state = 'unpublished';
                if($(this).is(':checked')) {
                    state = 'published';
                }
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.page.publicity.update')}}',
                    data: {id: $(this).data('id'), published: $(this).is(':checked'), _method: 'PUT'},
                    success: function (data) {
                        console.log(data);
                        M.toast({html: 'Success! Page ' + page + ' ' + state + '.', classes: 'green'});
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Page ' + page + ' hasn\'t been ' + state + '.', classes: 'red'});
                    }
                });
            });

            $('#add_page').submit(function (e) {
                e.preventDefault();
                var data = {
                    title: $('#page_title').val(),
                    url: $('#page_url').val(),
                    description: $('#page_description').val(),
                    keywords: $('#page_keywords').val(),
                    page_template_id: $('#page_template_id').val(),
                    categories: $('#page_categories').val()
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
                        window.location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Page hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
                $(this).find('textarea').val('');
            });
        });
    </script>
@endpush