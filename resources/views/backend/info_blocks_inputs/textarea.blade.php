<div class="input-field col s12">
    <label class="{{empty($data['value']) ? "" : "active"}}" for="{{$data['for']}}">{{$data['title']}}</label>
    <textarea name="{{$data['name']}}" id="{{$data['id']}}" class="materialize-textarea wysiwyg-textarea">{{$data['value']}}</textarea>
</div>