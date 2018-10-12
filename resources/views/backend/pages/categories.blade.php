@extends('backend.layouts.index')

@section('content')
    <div class="mb-5">
        <h1 class="center-align">Categories</h1>
        <table class="highlight" id="categories_table">
            <tr>
                <th>Name</th>
                <th>Parent</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->title}}</td>
                    <td>{{$category->parent() ? $category->parent()->title : ''}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.category.edit', $category->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit category">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete category"
                           data-id="{{$category->id}}"
                           onclick="openConfirmModal(this, 'deleteCategory')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new category" data-target="modal_create_category">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Category Modal -->
    <div id="modal_create_category" class="modal">
        <div class="modal-content">
            <h4>Creating new category</h4>
            <div class="row">
                <form id="add_category" onkeypress="return event.keyCode != 13;" class="col s12">
                    <h5>Main</h5>
                    <div class="input-field col s6">
                        <label for="category_title">Title</label>
                        <input type="text" name="category_title" id="category_title">
                    </div>
                    <div class="input-field col s6">
                        <label for="category_url">URL</label>
                        <input type="text" name="category_url" id="category_url">
                    </div>
                    <div class="input-field col s12">
                        <label for="category_design_blocks" class="active">Choose excerpt design blocks</label>
                        <select type="text" name="category_design_blocks" id="category_design_blocks" multiple>
                            <option value="" selected disabled></option>
                            @foreach($design_blocks as $design_block)
                                <option value="{{$design_block->title}}">{{$design_block->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label for="category_page_template_id" class="active">Choose page template</label>
                        <select name="category_page_template_id" id="category_page_template_id">
                            <option value="" disabled selected></option>
                            @foreach($page_templates as $page_template)
                                <option value="{{$page_template->id}}">{{$page_template->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <label for="category_parent_id" class="active">Choose parent category</label>
                        <select name="category_parent_id" id="category_parent_id">
                            <option value="" disabled selected></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h5>SEO</h5>
                    <div class="input-field col s6">
                        <label for="category_description">Description</label>
                        <textarea id="category_description" class="materialize-textarea" name="category_description"></textarea>
                    </div>
                    <div class="input-field col s6">
                        <label for="category_keywords">Keywords</label>
                        <textarea name="category_keywords" id="category_keywords" class="materialize-textarea"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_category" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>

        function deleteCategory(elem) {
            var id = $(elem).data('id');
            var that = elem;
            $.ajax({
                type: 'POST',
                url: '{{route('api.category.delete')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    _method: 'DELETE'
                },
                success: function(data) {
                    console.log(data);
                    data = data.status;
                    if (data) {
                        $(that).parent().parent().remove();
                        M.toast({html: 'Success! Category has been deleted', classes: 'green'});
                    }
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Category hasn\'t been deleted', classes: 'red'});
                }
            });
        }

        $(document).ready(function() {
            $('#add_category').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{route('api.category.add')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: $('#category_title').val(),
                        url: $('#category_url').val(),
                        design_blocks: $('#category_design_blocks').val(),
                        parent_category: $('#category_parent_id').val(),
                        page_template_id: $('#category_page_template_id').val(),
                        description: $('#category_description').val(),
                        keywords: $('#category_keywords').val()
                    },
                    success: function(data) {
                        console.log(data);
                        category = data.category;
                        M.toast({html: 'Success! Category has been created', classes: 'green'});
                        $('#categories_table').append('<tr>\n' +
                            '                    <td>'+category.title+'</td>\n' +
                            '                    <td>'+(category.parent ? category.parent.title : "")+'</td>\n' +
                            '                    <td class="right">\n' +
                            '                        <a href="/dashboard/categories/edit/'+category.id+'"\n' +
                            '                           class="btn btn-floating waves-effect waves-light orange tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Edit category">\n' +
                            '                            <i class="material-icons">edit</i>\n' +
                            '                        </a>\n' +
                            '                        <a class="btn btn-floating waves-effect waves-light red tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Delete category"\n' +
                            '                           data-id="'+category.id+'"\n' +
                            '                           onclick="openConfirmModal(this, \'deleteCategory\')">\n' +
                            '                            <i class="material-icons">delete</i>\n' +
                            '                        </a>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Category hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input, textarea').val('');
            });
        });
    </script>
@endpush