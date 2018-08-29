<div class="input-field col s12">
    <label class="{{empty($data['value']) ? "" : "active"}}" for="{{$data['for']}}">{{$data['title']}}</label>
    <input type="text" name="{{$data['name']}}" id="{{$data['id']}}" value="{{$data['value']}}">
</div>