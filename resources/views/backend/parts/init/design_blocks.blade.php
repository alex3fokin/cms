<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new design block</h3>
        <form method="POST" id="add_design_block" onkeypress="return event.keyCode != 13;">
            <div class="input-field col s6">
                <label for="design_block_title">Title</label>
                <input type="text" name="design_block_title" id="design_block_title">
            </div>
            <div class="input-field col s6">
                <label for="design_block_view">View</label>
                <input type="text" name="design_block_view" id="design_block_view">
            </div>
            <div class="col s12">
                <label class="active" for="design_block_css_classes">CSS Classes</label>
                <input type="text" name="design_block_css_classes" id="design_block_css_classes" data-role="tagsinput">
            </div>
            <div class="col s12">
                <label class="active" for="design_block_children_design_blocks">Design blocks</label>
                <input type="text" name="design_block_children_design_blocks" id="design_block_children_design_blocks" data-role="tagsinput">
            </div>
            <div class="col s12">
                <p>Add info blocks</p>
                <div class="row">
                    <div class="col s5">
                        <label for="design_block_info_block_title">Title</label>
                        <input type="text" name="design_block_info_block_title" id="design_block_info_block_title">
                    </div>
                    <div class="col s5">
                        <label for="design_block_info_block_id">Type</label>
                        <select name="design_block_info_block_id" id="design_block_info_block_id">
                            <option value="" disabled selected>Choose info block type</option>
                            @foreach($available_block_types as $block_type)
                                <option value="{{$block_type->id}}">{{$block_type->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s2">
                        <button type="button" class="btn waves-effect waves-light" name="action" id="design_block_add_info_block">Add
                            <i class="material-icons right">add</i>
                        </button>
                    </div>
                </div>
                <p class="center-align">Info blocks</p>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="design_block_info_blocks_table">
                    </tbody>
                </table>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <h3 class="center-align">All design blocks</h3>
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>View</th>
                <th>CSS Classes</th>
                <th>Design Blocks</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="design_blocks_table">
            @foreach($design_blocks as $design_block)
                <tr>
                    <td>
                        <div class="input-field col">
                            <label for="design_block_title_{{$design_block->id}}">Title</label>
                            <input type="text" name="design_block_title_{{$design_block->id}}"
                                   id="design_block_title_{{$design_block->id}}" value="{{$design_block->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col">
                            <label for="design_block_view_{{$design_block->id}}">View</label>
                            <input type="text" name="design_block_view_{{$design_block->id}}" id="design_block_view_{{$design_block->id}}"
                                   value="{{$design_block->view}}">
                        </div>
                    </td>
                    <td>
                        <div class="col s12">
                            <label class="active" for="design_block_css_classes_{{$design_block->id}}">CSS Classes</label>
                            <input type="text" name="design_block_css_classes_{{$design_block->id}}"
                                   id="design_block_css_classes_{{$design_block->id}}" data-role="tagsinput"
                                   value="{{str_replace(' ', ',', $design_block->css_classes)}}">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <label class="active" for="design_block_children_design_blocks_{{$design_block->id}}">Design blocks</label>
                            <input type="text" name="design_block_children_design_blocks_{{$design_block->id}}"
                                   id="design_block_children_design_blocks_{{$design_block->id}}" value="{{$design_block->design_blocks}}" data-role="tagsinput">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green"
                                data-id="{{$design_block->id}}" onclick="updateDesignBlock(this)"><i
                                    class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red"
                                data-id="{{$design_block->id}}" onclick="deleteDesignBlock(this)"><i
                                    class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table>

        </table>
    </div>
</div>

@push('after-scripts')
    <script>
        var available_design_blocks = {!! json_encode($available_design_blocks) !!};
        var available_block_types = {!! json_encode($available_block_types) !!};

        function removeDesignBlockInfoBlock(elem) {
            $(elem).parent().parent().remove();
        }

        function updateDesignBlock(elem) {
            var id = $(elem).data('id');
            var css_classes = $('#design_block_css_classes_' + id).val();
            var replace = new RegExp(',', 'g');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.design_block.update')}}',
                data: {
                    id: id,
                    view: $('#design_block_view_' + id).val(),
                    title: $('#design_block_title_' + id).val(),
                    css_classes: css_classes.replace(replace, ' '),
                    design_blocks: $('#design_block_children_design_blocks_' + id).val().split(','),
                    _method: 'PUT'
                },
                success: function (data) {
                    console.log(data);
                    available_design_blocks = data.design_blocks;
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }

        function deleteDesignBlock(elem) {
            var id = $(elem).data('id');
            var that = elem;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.design_block.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function (data) {
                    data = data.status;
                    if (data) {
                        $(that).parent().parent().remove();
                    }
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }

        $(document).ready(function () {
            $('#design_block_add_info_block').click(function () {
                var info_blocks_select_options = '';
                var current_info_block_type_id = $('#design_block_info_block_id').val();
                available_block_types.forEach(function (info_block) {
                    var selected = parseInt(current_info_block_type_id) === parseInt(info_block.id) ? 'selected' : '';
                    info_blocks_select_options += '<option value="'+info_block.id+'" '+ selected +'>'+info_block.type+'</option>';
                });
                $('#design_block_info_blocks_table').append('<tr>\n' +
                    '                            <td>\n' +
                    '                                <div class="col s12">\n' +
                    '                                    <label for="design_block_info_blocks_title">Title</label>\n' +
                    '                                    <input type="text" class="design_block_info_blocks_title" value="'+$('#design_block_info_block_title').val()+'">\n' +
                    '                                </div>\n' +
                    '                            </td>\n' +
                    '                            <td>\n' +
                    '                                <div class="col s12">\n' +
                    '                                    <label for="design_block_info_blocks_id">Type</label>\n' +
                    '                                    <select class="design_block_info_blocks_id">\n' +
                    '                                        <option value="" disabled selected>Choose info block type</option>\n' + info_blocks_select_options +
                    '                                    </select>\n' +
                    '                                </div>\n' +
                    '                            </td>\n' +
                    '                            <td>\n' +
                    '                                <button type="button" class="btn-floating waves-effect waves-light red" name="action" onclick="removeDesignBlockInfoBlock(this)">\n' +
                    '                                    <i class="material-icons right">delete</i>\n' +
                    '                                </button>\n' +
                    '                            </td>\n' +
                    '                        </tr>');
                $('#design_block_info_block_id').val('');
                $('#design_block_info_block_title').val("");
            });

            $('input[id^="design_block_children_design_blocks"]').on('itemAdded', function (event) {
                if ($.inArray(event.item, available_design_blocks) === -1) {
                    $(this).tagsinput('remove', event.item);
                }
            });

            $('#add_design_block').submit(function (e) {
                e.preventDefault();
                var replace = new RegExp(',', 'g');
                var info_blocks = [];
                var info_blocks_count = $('.design_block_info_blocks_title').length;
                for(i = 0; i < info_blocks_count; i++) {
                    info_blocks.push({title: $('.design_block_info_blocks_title').eq(i).val(), id: $('.design_block_info_blocks_id').eq(i).val()});
                }
                var data = {
                    title: $('#design_block_title').val(),
                    view: $('#design_block_view').val(),
                    css_classes: $('#design_block_css_classes').val().replace(replace, ' '),
                    design_blocks: $('#design_block_children_design_blocks').val().split(','),
                    info_blocks: info_blocks
                };
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.design_block.add')}}',
                    data: data,
                    success: function (data) {
                        console.log(data);
                        data = data.design_block;
                        var replace = new RegExp(' ', 'g');
                        var css_classes = '';
                        var design_blocks = '';
                        if (data.css_classes) {
                            css_classes = data.css_classes.replace(replace, ',');
                        }
                        if (data.design_blocks) {
                            design_blocks = data.design_blocks;
                        }
                        $('#design_blocks_table').append('<tr>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="design_block_title_' + data.id + '">Title</label>\n' +
                            '                            <input type="text" name="design_block_title_' + data.id + '" id="design_block_title_' + data.id + '" value="' + data.title + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="design_block_view_' + data.id + '">View</label>\n' +
                            '                            <input type="text" name="design_block_view_' + data.id + '" id="design_block_view_' + data.id + '" value="' + data.view + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="col s12">\n' +
                            '                            <label class="active" for="design_block_css_classes_' + data.id + '">CSS Classes</label>\n' +
                            '                            <input type="text" name="design_block_css_classes_' + data.id + '" id="design_block_css_classes_' + data.id + '" value="' + css_classes + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="col">\n' +
                            '                            <label class="active" for="design_block_children_design_blocks_' + data.id + '">Design blocks</label>\n' +
                            '                            <input type="text" name="design_block_children_design_blocks_' + data.id + '" id="design_block_children_design_blocks_' + data.id + '" value="' + design_blocks + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <button class="btn-floating waves-effect waves-light green" data-id="' + data.id + '" onclick="updateDesignBlock(this)"><i class="material-icons">save</i></button>\n' +
                            '                        <button class="btn-floating waves-effect waves-light red" data-id="' + data.id + '" onclick="deleteDesignBlock(this)"><i class="material-icons">delete</i></button>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                        available_design_blocks.push(data.name);
                        $('#design_block_children_design_blocks_' + data.id).tagsinput();
                        $('#design_block_css_classes_' + data.id).tagsinput();
                        $('#design_block_children_design_blocks_' + data.id).on('itemAdded', function (event) {
                            if ($.inArray(event.item, available_design_blocks) === -1) {
                                $(this).tagsinput('remove', event.item);
                            }
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
                $(this).find('input').val('');
                $('#design_block_css_classes').tagsinput('removeAll');
                $('#design_block_children_design_blocks').tagsinput('removeAll');
                $('#design_block_info_blocks_table').html('');
            });
        });
    </script>
@endpush