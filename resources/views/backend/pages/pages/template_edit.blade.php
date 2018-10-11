@extends('backend.pages.index')

@section('content')
    <div>
        <h1 class="center-align">Edit page template</h1>
        <form id="edit_page_template" method="POST">
            <div class="row">
                <div class="input-field col s6">
                    <label for="page_template_title">Title</label>
                    <input type="text" name="page_template_title" id="page_template_title" value="{{$page_template->title}}">
                </div>
                <div class="input-field col s6">
                    <label for="page_template_view">View</label>
                    <input type="text" name="page_template_view" id="page_template_view" value="{{$page_template->view}}">
                </div>
            </div>
        </form>
        <div class="fixed-action-btn">
            <button type="submit" form="edit_page_template" class="btn-floating btn-large green">
                <i class="large material-icons">save</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $('#edit_page_template').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.page_template.update')}}',
                    data: {id: {{$page_template->id}}, view: $('#page_template_view').val(), title: $('#page_template_title').val(), _method: 'PUT'},
                    success:function(data){
                        console.log(data);
                        M.toast({html: 'Success! Page template has been updated.', classes: 'green'});
                    },
                    error:function(data){
                        console.log(data);
                        M.toast({html: 'Error! Page template hasn\'t been updated.', classes: 'red'});
                    },
                });
            });
        });
    </script>
@endpush