@extends('backend.layouts.index')

@section('content')
    <div>
        <h1 class="center-align">Admin settings</h1>
        <div class="row">
            <div class="col s12">
                <form action="#" method="POST" id="admin_settings_form">
                    <div class="row">
                        <div class="input-field col s2">
                            <p><b>Email:</b></p>
                        </div>
                        <div class="input-field col s10">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{$admin->email}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button type="submit" form="admin_settings_form" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#admin_settings_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('admin.settings.update', $admin->id)}}',
                    data: $(this).serialize(),
                    success: function(data) {
                        console.log(data);
                        M.toast({html: 'Success! Settings has been updated', classes: 'green'});
                    },
                    error: function(data) {
                        console.log(data);
                        M.toast({html: 'Error! Settings hasn\'t been updated', classes: 'red'});
                    }
                });
            });
        });
    </script>
@endpush