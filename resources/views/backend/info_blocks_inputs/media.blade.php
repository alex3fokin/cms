<div class="row">
    <div class="col s12 m2">
        <label>{{$data['title']}}</label>
        <div class="card img-input-card" id="{{$data['media_card_id']}}">
            <div class="card-image">
                <img id="img_src" src="{{$data['media_file_path'] ? $data['media_file_path'] : '/storage/media/document.png'}}">
                <div class="card-image-overlay">
                    <p>
                        Choose a file
                    </p>
                    <button data-target="modalPullOfFiles" class="btn-floating waves-effect waves-light green modal-trigger"
                            data-initiator="#{{$data['media_card_id']}}" onclick="setInitiator(this)"><i class="material-icons">add</i>Select
                    </button>
                </div>
            </div>
            <div class="card-content">
                <div class="input-field">
                    <input type="hidden" id="{{$data['media_file_name_id']}}" name="{{$data['media_file_name_name']}}" value="{{$data['media_file_name_value']}}">
                    <label for="{{$data['media_alt_label']}}">Alt</label>
                    <input type="text" name="{{$data['media_alt_name']}}" id="{{$data['media_alt_id']}}" value="{{$data['media_alt_value']}}">
                </div>
            </div>
        </div>
    </div>
</div>