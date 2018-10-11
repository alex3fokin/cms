@extends('backend.layouts.index')

@section('content')
    <div>
        <h1 class="center-align">Locales</h1>
        <div class="row">

            <div class="input-field col s2">
                <p>
                    <b>Default language: </b>
                </p>
            </div>
            <div class="input-field col s9">
                <select id="default_locale">
                    <option value="" selected disabled>Choose locale</option>
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($locale->id) === intval($default_language) ? 'selected' : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field col s1">
                <button class="btn-floating waves-effect waves-light green tooltipped" type="button" name="action"
                        onclick="updateDefaultLocale()"
                data-position="top" data-tooltip="Save default locale">
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>
        <table class="highlight" id="locales_table">
            <tr>
                <th>Name</th>
                <th>Short code</th>
                <th class="right">Actions</th>
            </tr>
            @foreach($locales as $locale)
                <tr>
                    <td>{{$locale->title}}</td>
                    <td>{{$locale->short_code}}</td>
                    <td class="right">
                        <a href="{{route('dashboard.locale.edit', $locale->id)}}"
                           class="btn btn-floating waves-effect waves-light orange tooltipped"
                           data-position="top" data-tooltip="Edit locale">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn btn-floating waves-effect waves-light red tooltipped"
                           data-position="top" data-tooltip="Delete locale"
                           data-id="{{$locale->id}}"
                           onclick="openConfirmModal(this, 'deleteLocale')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="fixed-action-btn">
        <button class="btn-floating btn-large green tooltipped modal-trigger"
                data-position="left" data-tooltip="Create new locale" data-target="modal_create_locale">
            <i class="large material-icons">add</i>
        </button>
    </div>
    <!-- Create New Locale Modal -->
    <div id="modal_create_locale" class="modal">
        <div class="modal-content">
            <h4>Creating new locale</h4>
            <div class="row">
                <form id="add_locale" method="POST">
                    <div class="input-field col s6">
                        <label for="locale_title">Title</label>
                        <input type="text" name="locale_title" id="locale_title">
                    </div>
                    <div class="input-field col s6">
                        <label for="locale_short_code">Short code</label>
                        <input type="text" name="locale_short_code" id="locale_short_code">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button href="#!" class="modal-close waves-effect waves-red btn-floating white tooltipped"
                    data-position="top" data-tooltip="Cancel">
                <i class="material-icons red-text">cancel</i>
            </button>
            <button type="submit" form="add_locale" href="#!"
                    class="modal-close waves-effect waves-green btn-floating white tooltipped" data-position="top"
                    data-tooltip="Create">
                <i class="material-icons green-text">add</i>
            </button>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function updateDefaultLocale() {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.default.locale.update')}}',
                data: {
                    default_locale: $('#default_locale').val(),
                    _method: 'PUT'
                },
                success:function(data) {
                    console.log(data);
                    M.toast({html: 'Success! Default locale has been changed.', classes: 'green'});
                },
                error: function(data) {
                    console.log(data);
                    M.toast({html: 'Error! Default locale hasn\'t been changed.', classes: 'red'});
                }
            });
        }

        function deleteLocale(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.locale.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success: function (data) {
                    data = data.status;
                    if (data) {
                        $(elem).parent().parent().remove();
                        M.toast({html: 'Success! Locale has been deleted', classes: 'green'});
                    }
                },
                error: function (data) {
                    console.log(data);
                    M.toast({html: 'Error! Locale hasn\'t been deleted', classes: 'red'});
                },
            });
        }

        $(document).ready(function () {
            $('#add_locale').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('api.locale.add')}}',
                    data: {
                        title: $('#locale_title').val(),
                        short_code: $('#locale_short_code').val(),
                    },
                    success: function (data) {
                        console.log(data);
                        locale = data.locale;
                        M.toast({html: 'Success! Locale has been created', classes: 'green'});
                        $('#locales_table').append('<tr>\n' +
                            '                    <td>' + locale.title + '</td>\n' +
                            '                    <td>' + locale.short_code + '</td>\n' +
                            '                    <td class="right">\n' +
                            '                        <a href="/admin/locales/edit/' + locale.id + '"\n' +
                            '                           class="btn btn-floating waves-effect waves-light orange tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Edit locale">\n' +
                            '                            <i class="material-icons">edit</i>\n' +
                            '                        </a>\n' +
                            '                        <a class="btn btn-floating waves-effect waves-light red tooltipped"\n' +
                            '                           data-position="top" data-tooltip="Delete locale"\n' +
                            '                           data-id="' + locale.id + '"\n' +
                            '                           onclick="openConfirmModal(this, \'deleteLocale\')">\n' +
                            '                            <i class="material-icons">delete</i>\n' +
                            '                        </a>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                    },
                    error: function (data) {
                        console.log(data);
                        M.toast({html: 'Error! Locale hasn\'t been created', classes: 'red'});
                    }
                });
                $(this).find('input').val('');
            });
        });
    </script>
@endpush