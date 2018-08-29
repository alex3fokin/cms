<div class="row" id="container_{{$data[0]['media_card_id']}}">
    @php
        $index = 0
    @endphp
    @foreach($data as $data_item)
        @php
            $index++
        @endphp
        <div class="col s12 m2">
            <div class="card img-input-card" id="{{$data_item['media_card_id']}}">
                <div class="card-image">
                    <img id="img_src" src="{{$data_item['media_file_path'] ? $data_item['media_file_path'] : '/storage/document.png'}}">
                    <div class="card-image-overlay">
                        <p>
                            Choose a file
                        </p>
                        <button data-target="modalPullOfFiles" class="btn-floating waves-effect waves-light green modal-trigger"
                                data-initiator="#{{$data_item['media_card_id']}}" onclick="setInitiator(this)"><i class="material-icons">add</i>Select
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="input-field">
                        <input type="hidden" id="{{$data_item['media_file_name_id']}}" name="{{$data_item['media_file_name_name']}}" value="{{$data_item['media_file_name_value']}}">
                        <label for="{{$data_item['media_alt_label']}}">Alt</label>
                        <input type="text" name="{{$data_item['media_alt_name']}}" id="{{$data_item['media_alt_id']}}" value="{{$data_item['media_alt_value']}}">
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn-floating waves-effect waves-light red" onclick="deleteMediaCard(this)"><i class="material-icons">delete</i></button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<button class="btn waves-effect waves-light" type="button" name="action" onclick="addNewMediaSelect_{{$data[0]['media_card_id']}}('#container_{!! $data[0]['media_card_id'] !!}')">Add new media
    <i class="material-icons right">add</i>
</button>

@push('after-scripts')
    <script>
        var media_card_id_{{$data[0]['media_card_id']}} = '{!! $data[0]['media_card_id'] !!}';
        var media_card_current_index_{{$data[0]['media_card_id']}} = {{$index}};
        function addNewMediaSelect_{{$data[0]['media_card_id']}}(media_container) {
            $(media_container).append('<div class="col s12 m2">\n' +
                '        <div class="card img-input-card" id="'+media_card_id_{{$data[0]['media_card_id']}}+'_'+media_card_current_index_{{$data[0]['media_card_id']}}+'">\n' +
                '            <div class="card-image">\n' +
                '                <img id="img_src" src="/storage/document.png">\n' +
                '                <div class="card-image-overlay">\n' +
                '                    <p>\n' +
                '                        Choose a file\n' +
                '                    </p>\n' +
                '                    <button data-target="modalPullOfFiles" class="btn-floating waves-effect waves-light green modal-trigger"\n' +
                '                            data-initiator="#'+media_card_id_{{$data[0]['media_card_id']}}+'_'+media_card_current_index_{{$data[0]['media_card_id']}}+'" onclick="setInitiator(this)"><i class="material-icons">add</i>Select\n' +
                '                    </button>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="card-content">\n' +
                '                <div class="input-field">\n' +
                '                    <input type="hidden" id="{{$data[0]['media_file_name_id']}}" name="{{$data[0]['media_file_name_id']}}['+media_card_current_index_{{$data[0]['media_card_id']}}+'][name]" value="">\n' +
                '                    <label for="{{$data[0]['media_alt_label']}}">Alt</label>\n' +
                '                    <input type="text" name="{{$data[0]['media_file_name_id']}}['+media_card_current_index_{{$data[0]['media_card_id']}}+'][alt]" id="{{$data[0]['media_alt_id']}}">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '<div class="card-action">\n' +
                '                <button class="btn-floating waves-effect waves-light red" onclick="deleteMediaCard(this)"><i class="material-icons">delete</i></button>\n' +
                '            </div>'+
                '        </div>\n' +
                '    </div>');
            media_card_current_index_{{$data[0]['media_card_id']}}++;
        }

        function deleteMediaCard(elem) {
            $(elem).parent().parent().parent().remove();
        }
    </script>
@endpush