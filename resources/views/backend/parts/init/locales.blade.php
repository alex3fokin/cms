<div class="row">
    <div class="col s12">
        <h3 class="center-align">Add new locale</h3>
        <form id="add_locale" method="POST">
            <div class="input-field col s6">
                <label for="locale_title">Title</label>
                <input type="text" name="locale_title" id="locale_title">
            </div>
            <div class="input-field col s6">
                <label for="locale_short_code">Short code</label>
                <input type="text" name="locale_short_code" id="locale_short_code">
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">add</i>
            </button>
        </form>
        <h3 class="center-align">Set default locale</h3>
        <div class="row">
            <div class="col s12">
                <select id="default_locale">
                    <option value="" selected disabled>Choose locale</option>
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($locale->id) === intval($default_language) ? 'selected' : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="button" name="action" onclick="updateDefaultLocale()">Set
                    <i class="material-icons right">done</i>
                </button>
            </div>
        </div>
        <h3 class="center-align">All locales</h3>
        <table class="highlight">
            <thead>
            <tr>
                <th>Title</th>
                <th>Short code</th>
            </tr>
            </thead>
            <tbody id="locale_table">
            @foreach($locales as $locale)
                <tr>
                    <td>
                        <div class="input-field col">
                            <label class="active" for="locale_title_{{$locale->id}}">Title</label>
                            <input type="text" name="locale_title_{{$locale->id}}" id="locale_title_{{$locale->id}}"
                                   value="{{$locale->title}}">
                        </div>
                    </td>
                    <td>
                        <div class="input-field col">
                            <label class="active" for="locale_short_code_{{$locale->id}}">Short code</label>
                            <input type="text" name="locale_short_code_{{$locale->id}}"
                                   id="locale_short_code_{{$locale->id}}" value="{{$locale->short_code}}">
                        </div>
                    </td>
                    <td>
                        <button class="btn-floating waves-effect waves-light green" data-id="{{$locale->id}}"
                                onclick="updateLocale(this)"><i class="material-icons">save</i></button>
                        <button class="btn-floating waves-effect waves-light red" data-id="{{$locale->id}}"
                                onclick="openConfirmModal(this, 'deleteLocale')"><i class="material-icons">delete</i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

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
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function updateLocale(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.locale.update')}}',
                data: {
                    id: id,
                    title: $('#locale_title_' + id).val(),
                    short_code: $('#locale_short_code_' + id).val(),
                    locale_id: $('#locale_select_id').val(),
                    _method: 'PUT'
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }

        function deleteLocale(elem) {
            var id = $(elem).data('id');
            var that = elem;
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
                        $(that).parent().parent().remove();
                    }
                },
                error: function (data) {
                    console.log(data);
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
                        data = data.locale;
                        $('#locale_table').append('<tr>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="locale_title_' + data.id + '">Title</label>\n' +
                            '                            <input type="text" name="locale_title_' + data.id + '" id="locale_title_' + data.id + '" value="' + data.title + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <div class="input-field col">\n' +
                            '                            <label class="active" for="locale_short_code_' + data.id + '">Short code</label>\n' +
                            '                            <input type="text" name="locale_short_code_' + data.id + '" id="locale_short_code_' + data.id + '" value="' + data.short_code + '">\n' +
                            '                        </div>\n' +
                            '                    </td>\n' +
                            '                    <td>\n' +
                            '                        <button class="btn-floating waves-effect waves-light green" data-id="' + data.id + '" onclick="updateLocale(this)"><i class="material-icons">save</i></button>\n' +
                            '                        <button class="btn-floating waves-effect waves-light red" data-id="' + data.id + '" onclick="deleteLocale(this)"><i class="material-icons">delete</i></button>\n' +
                            '                    </td>\n' +
                            '                </tr>');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
                $(this).find('input').val('');
            });
        });
    </script>
@endpush