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
                    @foreach($locales as $locale_item)
                        <option value="{{$locale_item->id}}" {{intval($current_locale) === intval($locale_item->id) ? "selected" : ''}}>{{$locale_item->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h1 class="center-align">Edit Locale</h1>
        <div class="row">
            <form id="form_update_locale" method="POST">
                <div class="input-field col s6">
                    <label class="active" for="locale_title">Title</label>
                    <input type="text" name="locale_title" id="locale_title" value="{{$locale->title}}">
                </div>
                <div class="input-field col s6">
                    <label class="active" for="locale_short_code">Short code</label>
                    <input type="text" name="locale_short_code" id="locale_short_code" value="{{$locale->short_code}}">
                </div>
            </form>
        </div>
    </div>
    <div class="fixed-action-btn">
        <button id="btn_update_locale" type="submit" form="form_update_locale"
                class="btn-floating btn-large green tooltipped"
                data-position="left" data-tooltip="Save changes">
            <i class="large material-icons">save</i>
        </button>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $('#locale_select_id').change(function () {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('#form_update_locale').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.locale.update')}}',
                    data: {
                        id: {{$locale->id}},
                        title: $('#locale_title').val(),
                        short_code: $('#locale_short_code').val(),
                        locale_id: $('#locale_select_id').val(),
                        _method: 'PUT'
                    },
                    success: function (data) {
                        console.log(data);
                        M.toast({html: 'Success! Locale has been updated.', classes: 'green'});
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Locale hasn\'t been updated.', classes: 'red'});
                    },
                });
            });
        });
    </script>
@endpush