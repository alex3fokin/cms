@extends('backend.layouts.index')

@section('content')
    <div>
        <div class="row">
            <div class="col s2">
                <p>
                    <b>Select language</b>
                </p>
            </div>
            <div class="col s10">
                <select id="locale_select_id">
                    <option value="" selected>Choose language</option>
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($current_locale) === intval($locale->id) ? "selected" : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h1 class="center-align">Edit general info item</h1>
        <div class="row">
            <form id="form_update_general_info_item" method="POST">
                <div class="input-field col s12">
                    <label class="active" for="general_info_title">Title</label>
                    <input type="text" name="general_info_title" id="general_info_title" value="{{$general_info->title}}">
                </div>
                <div class="input-field col s12">
                    <label class="active" for="general_info_value">Value</label>
                    <input type="text" name="general_info_value" id="general_info_value" value="{{$general_info->value}}">
                </div>
            </form>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_general_info_item" type="submit" form="form_update_general_info_item" class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('#form_update_general_info_item').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.general_info.update')}}',
                    data: {
                        id: {{$general_info->id}},
                        value: $('#general_info_value').val(),
                        title: $('#general_info_title').val(),
                        locale_id: $('#locale_select_id').val(),
                        _method: 'PUT'
                    },
                    success:function(data){
                        console.log(data);
                        M.toast({html: 'Success! General info item has been updated', classes: 'green'});
                    },
                    error:function(data){
                        console.log(data);
                        M.toast({html: 'Error! General info item hasn\'t been updated', classes: 'red'});
                    },
                });
            });
        });
    </script>
@endpush