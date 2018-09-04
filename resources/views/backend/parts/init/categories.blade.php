<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new category</h3>
        <form method="POST" id="add_category" onkeypress="return event.keyCode != 13;">
            <h5>Main info</h5>
            <div class="input-field col s6">
                <label for="category_title">Title</label>
                <input type="text" name="category_title" id="category_title">
            </div>
            <div class="input-field col s6">
                <label for="category_url">URL</label>
                <input type="text" name="category_url" id="category_url">
            </div>
            <div class="col s12">
                <label class="active" for="category_design_blocks">Design blocks</label>
                <input type="text" name="category_design_blocks" id="category_design_blocks" data-role="tagsinput">
            </div>
            <div class="input-field col s12">
                <select name="category_parent_id" id="category_parent_id">
                    <option value="" selected>Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                <label class="active">Parent category</label>
            </div>
            <div class="input-field col s12">
                <select name="category_page_template_id" id="category_page_template_id">
                    <option value="" selected>Choose page template</option>
                    @foreach($page_templates as $page_template)
                        <option value="{{$page_template->id}}">{{$page_template->title}}</option>
                    @endforeach
                </select>
                <label class="active">Page template</label>
            </div>
            <h5>SEO info</h5>
            <div class="input-field col s6">
                <label for="category_description">Description</label>
                <textarea id="category_description" class="materialize-textarea" name="category_description"></textarea>
            </div>
            <div class="col s6">
                <label class="active" for="category_keywords">Keywords</label>
                <input type="text" name="category_keywords" id="category_keywords" data-role="tagsinput">
            </div>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Add
                    <i class="material-icons right">add</i>
                </button>
            </div>
        </form>
        <div class="row">
            <div class="col s12">
                <h3 class="center-align">All categories</h3>
            </div>
        </div>
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Design blocks</th>
                <th>Parent category</th>
                <th>Page template</th>
                <th>Description</th>
                <th>Keywords</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="categories_table">
            @foreach($categories as $category)
                <tr>
                    <td>
                        <div class="input-field col s12">
                            <label for="category_title_{{$category->id}}">Title</label>
                            <input type="text" name="category_title_{{$category->id}}" id="category_title_{{$category->id}}" value="{{$category->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <label for="category_url_{{$category->id}}">URL</label>
                            <input type="text" name="category_url_{{$category->id}}" id="category_url_{{$category->id}}" value="{{$category->url}}">
                        </div>
                    </td>
                    <td>
                        <div class="col s12">
                            <label class="active" for="category_design_blocks_{{$category->id}}">Design blocks</label>
                            <input type="text" name="category_design_blocks_{{$category->id}}" id="category_design_blocks_{{$category->id}}" data-role="tagsinput" value="{{$category->design_blocks}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <select name="category_parent_id_{{$category->id}}" id="category_parent_id_{{$category->id}}">
                                <option value="" selected>Choose category</option>
                                @foreach($categories as $category_item)
                                    <option value="{{$category_item->id}}" {{$category->parent_category === $category_item->id ? 'selected' : ''}}>{{$category_item->title}}</option>
                                @endforeach
                            </select>
                            <label class="active">Parent category</label>
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <select name="category_page_template_id_{{$category->id}}" id="category_page_template_id_{{$category->id}}">
                                <option value="" disabled selected>Choose page template</option>
                                @foreach($page_templates as $page_template)
                                    <option value="{{$page_template->id}}" {{$category->page_template_id == $page_template->id ? 'selected' : ''}}>{{$page_template->title}}</option>
                                @endforeach
                            </select>
                            <label class="active">Page template</label>
                        </div>
                    </td>
                    <td>
                        <div class="input-field col s12">
                            <label for="category_description_{{$category->id}}">Description</label>
                            <textarea id="category_description_{{$category->id}}" class="materialize-textarea" name="category_description_{{$category->id}}">{{$category->seo->description}}</textarea>
                        </div>
                    </td>
                    <td>
                        <div class="col s12">
                            <label class="active" for="category_keywords_{{$category->id}}">Keywords</label>
                            <input type="text" name="category_keywords_{{$category->id}}" id="category_keywords_{{$category->id}}" data-role="tagsinput" value="{{$category->seo->keywords}}">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green"
                                data-id="{{$category->id}}" onclick="updateCategory(this)"><i
                                    class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red"
                                data-id="{{$category->id}}" onclick="deleteCategory(this)"><i
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

        function updateCategory(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                url: '{{route('api.category.update')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    title: $('#category_title_' + id).val(),
                    url: $('#category_url_' + id).val(),
                    design_blocks: $('#category_design_blocks_' + id).val().split(','),
                    parent_category: $('#category_parent_id_' + id).val(),
                    page_template_id: $('#category_page_template_id_' + id).val(),
                    description: $('#category_description_' + id).val(),
                    keywords: $('#category_keywords_' + id).val(),
                    locale_id: $('#locale_select_id').val(),
                    _method: 'PUT'
                },
                success: function(data) {
                    console.log(data);
                    M.toast({html: 'Category updated', classes: 'green'});
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

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
                        M.toast({html: 'Category deleted', classes: 'green'});
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function() {
            $('input[id^="category_design_blocks"]').on('itemAdded', function (event) {
                if ($.inArray(event.item, available_design_blocks) === -1) {
                    $(this).tagsinput('remove', event.item);
                }
            });

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
                        design_blocks: $('#category_design_blocks').val().split(','),
                        parent_category: $('#category_parent_id').val(),
                        page_template_id: $('#category_page_template_id').val(),
                        description: $('#category_description').val(),
                        keywords: $('#category_keywords').val()
                    },
                    success: function(data) {
                        console.log(data);
                        data = data.category;
                        window.location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
                $(this).find('input, textarea').val('');
                $('#category_design_blocks').tagsinput('removeAll');
                $('#category_keywords').tagsinput('removeAll');
            });
        });
    </script>
@endpush