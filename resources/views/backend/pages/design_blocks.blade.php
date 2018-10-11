@extends('backend.layouts.index')

@section('content')
    <div class="mb-5">
        <h1 class="center-align">Design blocks</h1>
        <table class="highlight" id="design_blocks_table">
            <tr>
                <th>Name</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($design_blocks as $design_block)
                <tr>
                    <td>{{$design_block->title}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.design_block.edit', $design_block->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit design block">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete design block"
                           data-id="{{$design_block->id}}"
                           onclick="openConfirmModal(this, 'deleteDesignBlock')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new design block" data-target="modal_create_design_block">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Design Block Modal -->
    <div id="modal_create_design_block" class="modal">
        <div class="modal-content">
            <h4>Creating new design block</h4>
            <div class="row">
                <form method="POST" id="add_design_block" onkeypress="return event.keyCode != 13;">
                    <h5>Main</h5>
                    <div class="input-field col s6">
                        <label for="design_block_title">Title</label>
                        <input type="text" name="design_block_title" id="design_block_title">
                    </div>
                    <div class="input-field col s6">
                        <label for="design_block_view">View</label>
                        <input type="text" name="design_block_view" id="design_block_view">
                    </div>
                    <div class="input-field col s12">
                        <label for="design_block_css_classes">CSS Classes</label>
                        <textarea class="materialize-textarea" name="design_block_css_classes"
                                  id="design_block_css_classes"></textarea>
                    </div>
                    <div class="input-field col s12">
                        <label class="active" for="design_block_children_design_blocks">Allowable nested design
                            blocks</label>
                        <select name="design_block_children_design_blocks" id="design_block_children_design_blocks"
                                multiple>
                            <option value="" selected disabled></option>
                            @foreach($design_blocks as $design_block)
                                <option value="{{$design_block->title}}">{{$design_block->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12">
                        <h5>Info blocks</h5>
                        <div class="row">
                            <div class="input-field col s6">
                                <label class="active" for="design_block_info_block_title">Title</label>
                                <input type="text" name="design_block_info_block_title"
                                       id="design_block_info_block_title">
                            </div>
                            <div class="input-field col s5">
                                <label class="active" for="design_block_info_block_id">Info block type</label>
                                <select name="design_block_info_block_id" id="design_block_info_block_id">
                                    <option value="" disabled selected></option>
                                    @foreach($info_blocks as $info_block)
                                        <option value="{{$info_block->id}}">{{$info_block->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field col s1">
                                <button type="button" class="btn-floating waves-effect waves-light green tooltipped"
                                        name="action" id="design_block_add_info_block"
                                data-position="top" data-tooltip="Add one more info block">
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                        <table>
                            <tbody id="design_block_info_blocks_table">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_design_block" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        var info_blocks = {!! json_encode($info_blocks) !!};

        function removeDesignBlockInfoBlock(elem) {
            $(elem).parent().parent().remove();
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
                        M.toast({html: 'Success! Design block has been deleted.', classes: 'green'});
                    }
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Design block hasn\'t been deleted.', classes: 'red'});
                },
            });
        }

        $(document).ready(function () {
            $('#design_block_add_info_block').click(function () {
                var info_blocks_select_options = '';
                var current_info_block_type_id = $('#design_block_info_block_id').val();
                info_blocks.forEach(function (info_block) {
                    var selected = parseInt(current_info_block_type_id) === parseInt(info_block.id) ? 'selected' : '';
                    info_blocks_select_options += '<option value="'+info_block.id+'" '+ selected +'>'+info_block.type+'</option>';
                });
                $('#design_block_info_blocks_table').append('<tr>\n' +
                    '                            <td>\n' +
                    '                                <div class="input-field col s12">\n' +
                    '                                    <label class="active" for="design_block_info_blocks_title">Title</label>\n' +
                    '                                    <input type="text" class="design_block_info_blocks_title" value="'+$('#design_block_info_block_title').val()+'">\n' +
                    '                                </div>\n' +
                    '                            </td>\n' +
                    '                            <td>\n' +
                    '                                <div class="input-field col s12">\n' +
                    '                                    <label class="active" for="design_block_info_blocks_id">Type</label>\n' +
                    '                                    <select class="design_block_info_blocks_id" name="" id="">\n' +
                    '                                        <option value="" disabled selected></option>\n' + info_blocks_select_options +
                    '                                    </select>\n' +
                    '                                </div>\n' +
                    '                            </td>\n' +
                    '                            <td>\n' +
                    '                                <button type="button" class="btn-floating waves-effect waves-light red tooltipped" name="action" onclick="removeDesignBlockInfoBlock(this)"' +
                    'data-position="top" data-tooltip="Delete info block">\n' +
                    '                                    <i class="material-icons right">delete</i>\n' +
                    '                                </button>\n' +
                    '                            </td>\n' +
                    '                        </tr>');
                $('#design_block_info_block_title').val("");
                $('.design_block_info_blocks_id').formSelect();
            });

            $('#add_design_block').submit(function(e) {
                e.preventDefault();
                var info_blocks = [];
                var info_blocks_count = $('.design_block_info_blocks_title').length;
                for(i = 0; i < info_blocks_count; i++) {
                    info_blocks.push({
                        title: $('.design_block_info_blocks_title').eq(i).val(),
                        id: $('.design_block_info_blocks_id').eq(i).val()});
                }
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.design_block.add')}}',
                    data: {
                        title: $('#design_block_title').val(),
                        view: $('#design_block_view').val(),
                        css_classes: $('#design_block_css_classes').val(),
                        design_blocks: $('#design_block_children_design_blocks').val(),
                        info_blocks: info_blocks
                    },
                    success: function (data) {
                        console.log(data);
                        window.location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Design block hasn\'t been created', classes: 'red'});
                    }
                });
            });
        });
    </script>
@endpush