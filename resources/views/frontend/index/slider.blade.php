<section id="featured" class="bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="main-slider" class="main-slider flexslider">
                    <ul class="slides">
                        @if($design_block->children)
                            @foreach($design_block->children as $slide)
                                @php
                                    $slide = $slide->mappedInfoBlocks($locale_id)
                                @endphp
                                <li>
                                    <img src="{{$slide['image']['path']}}" alt="{{$slide['image']['alt']}}"/>
                                    <div class="flex-caption">
                                        <h3>{!! $slide['heading'] !!}</h3>
                                        <p>{!! $slide['description'] !!}</p>
                                        <a href="{{$slide['link refference']}}" class="btn btn-theme">{!! $slide['link sign'] !!}</a>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>