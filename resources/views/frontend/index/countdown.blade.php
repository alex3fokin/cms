<section class="content">
    <div id="parallax1" class="parallax text-light text-center" data-stellar-background-ratio="0.5" style="background-image: url({{$data['image']['path']}});background-position: center;background-repeat: no-repeat;">
        <div class="container">
            <div class="row appear stats">
                @if($design_block->children)
                    @foreach($design_block->children as $countdown_item)
                        @php
                            $countdown_item = $countdown_item->mappedInfoBlocks($locale_id);
                        @endphp
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="align-center color-white txt-shadow">
                                <div class="icon">
                                    <i class="fa fa-{{$countdown_item['icon']}} fa-5x"></i>
                                </div>
                                <strong id="counter-{{$countdown_item['icon']}}" class="number">{!! $countdown_item['number'] !!}</strong><br/>
                                <span class="text">{!! $countdown_item['sign'] !!}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>