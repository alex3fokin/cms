<section class="content">
    <div class="container">
        <div class="row">
            @if($data['images'])
                @foreach($data['images'] as $image)
                    <div class="col-xs-6 col-md-2 aligncenter client">
                        <img alt="logo" src="{{$image['path']}}" class="img-responsive"/>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>