@extends('backend.layouts.index')

@section('content')
    <div>
        <h1 class="center-align">Edit design block</h1>
        <div class="row">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#main_tab">Main</a></li>
                <li class="tab"><a href="#info_blocks_tab">Info blocks</a></li>
            </ul>
        </div>

        <div id="main_tab">
            <div class="row">
                <form method="POST" id="form_update_design_block" onkeypress="return event.keyCode != 13;">
                    <div class="input-field col s6">
                        <label class="active" for="design_block_title">Title</label>
                        <input type="text" name="design_block_title" id="design_block_title"
                               value="{{$design_block->title}}">
                    </div>
                    <div class="input-field col s6">
                        <label class="active" for="design_block_view">View</label>
                        <input type="text" name="design_block_view" id="design_block_view"
                               value="{{$design_block->view}}">
                    </div>
                    <div class="input-field col s12">
                        <label class="active" for="design_block_css_classes">CSS Classes</label>
                        <textarea class="materialize-textarea" name="design_block_css_classes"
                                  id="design_block_css_classes">{{$design_block->css_classes}}</textarea>
                    </div>
                    <div class="input-field col s12">
                        <label class="active" for="design_block_children_design_blocks">Allowable nested design
                            blocks</label>
                        <select name="design_block_children_design_blocks" id="design_block_children_design_blocks"
                                multiple>
                            <option value="" selected disabled></option>
                            @php
                                $design_blocks_nested_elements = explode(',', $design_block->design_blocks);
                            @endphp
                            @foreach($design_blocks as $design_block_item)
                                <option value="{{$design_block_item->title}}" {{in_array($design_block_item->title, $design_blocks_nested_elements) ? 'selected' : ''}}>{{$design_block_item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div id="info_blocks_tab">
            <div class="row">
                <div class="col s12">
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
                        @foreach($design_block->info_blocks as $design_info_block)
                            <tr>
                                <td>
                                    <input type="hidden" class="design_block_info_block_id" value="{{$design_info_block->id}}">
                                    <div class="input-field col s12">
                                        <label class="active" for="design_block_info_blocks_title">Title</label>
                                        <input type="text" class="design_block_info_blocks_title"
                                               value="{{$design_info_block->title}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field col s12">
                                        <label class="active" for="design_block_info_blocks_id">Type</label>
                                        <select class="design_block_info_blocks_id">
                                            <option value="" selected disabled></option>
                                            @foreach($info_blocks as $info_block)
                                                <option value="{{$info_block->id}}" {{$info_block->id === $design_info_block->info_block_id ? 'selected' : ''}}>{{$info_block->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn-floating waves-effect waves-light red tooltipped"
                                            name="action" onclick="openConfirmModal(this, 'removeDesignBlockInfoBlock')"
                                            data-position="top" data-tooltip="Delete info block">
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_design_block" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        var info_blocks = {!! json_encode($info_blocks) !!};
        function removeDesignBlockInfoBlock(elem) {
            $(elem).parent().parent().remove();
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
                    '                                    <input type="hidden" class="design_block_info_block_id" value="-1">' +
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

            $('#form_update_design_block').submit(function(e) {
                e.preventDefault();
                var info_blocks = [];
                var info_blocks_count = $('.design_block_info_blocks_title').length;
                for(i = 0; i < info_blocks_count; i++) {
                    info_blocks.push({
                        title: $('.design_block_info_blocks_title').eq(i).val(),
                        id: $('.design_block_info_blocks_id').eq(i).val(),
                        design_block_info_block_id: $('.design_block_info_block_id').eq(i).val()});
                }
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.design_block.update')}}',
                    data: {
                        id: {{$design_block->id}},
                        view: $('#design_block_view').val(),
                        title: $('#design_block_title').val(),
                        css_classes: $('#design_block_css_classes' ).val(),
                        design_blocks: $('#design_block_children_design_blocks').val(),
                        info_blocks: info_blocks,
                        _method: 'PUT'
                    },
                    success: function (data) {
                        console.log(data);
                        M.toast({html: 'Success! Design block has been updated.', classes: 'green'});
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Design block hasn\'t been updated.', classes: 'red'});
                    },
                });
            });

            $('#btn_update_design_block').click(function() {
                $('#form_update_design_block').submit();
            });
        });
    </script>
@endpush