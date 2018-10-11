@extends('backend.layouts.index')

@section('content')
    <div class="mb-5">
        <h1 class="center-align">Widgets</h1>
        <table class="highlight">
            <tr>
                <th>Name</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($widgets as $widget)
                <tr>
                    <td>{{$widget->title}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.widget.edit', $widget->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit widget">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete widget"
                           data-id="{{$widget->id}}"
                           onclick="openConfirmModal(this, 'deleteWidget')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new widget" data-target="modal_create_widget">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Category Modal -->
    <div id="modal_create_widget" class="modal">
        <div class="modal-content">
            <h4>Creating new widget</h4>
            <div class="row">
                <form id="add_widget" onkeypress="return event.keyCode != 13;" class="col s12">
                    <h5>Main</h5>
                    <div class="input-field col s12">
                        <label for="widget_title">Title</label>
                        <input type="text" name="widget_title" id="widget_title">
                    </div>
                    <div class="input-field col s12">
                        <label for="widget_design_blocks" class="active">Choose excerpt design blocks</label>
                        <select type="text" name="widget_design_blocks" id="widget_design_blocks" multiple>
                            <option value="" selected disabled></option>
                            @foreach($design_blocks as $design_block)
                                <option value="{{$design_block->title}}">{{$design_block->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_widget" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
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
                        M.toast({html: 'Success! Widget has been deleted', classes: 'green'});
                    }
                },
                error:function(data){
                    console.log(data);
                    M.toast({html: 'Error! Widget hasn\'t been deleted', classes: 'red'});
                },
            });
        }

        $(document).ready(function() {
            $('#add_widget').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.widget.add')}}',
                    data: {
                        title: $('#widget_title').val(),
                        design_blocks: $('#widget_design_blocks').val()
                    },
                    success: function(data) {
                        console.log(data);
                        widget = data.widget;
                        M.toast({html: 'Success! Category has been created', classes: 'green'});
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Widget hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
            });
        })
    </script>
@endpush