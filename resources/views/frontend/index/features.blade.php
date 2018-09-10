<section id="features" class="section-features section-padding section-meta onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['subtitle'] !!}</h5>
            <h2 class="section-title">{!! $data['title'] !!}</h2></div>
        <div class="section-content">
            <div class="row">
                @if($design_block->children)
                    @foreach($design_block->children as $feauture_item)
                        @php
                            $feauture_item = $feauture_item->mappedInfoBlocks($locale_id);
                        @endphp
                        <div class="feature-item col-lg-3 col-sm-6 wow slideInUp"
                             style="visibility: hidden; animation-name: none;">
                            <div class="feature-media">
                                    <span class="fa-stack fa-5x"><i
                                                class="fa fa-circle fa-stack-2x icon-background-default"></i> <i
                                                class="feature-icon fa fa fa-{{$feauture_item['icon']}} fa-stack-1x"></i></span>
                            </div>
                            <h4>{!! $feauture_item['heading'] !!}</h4>
                            <div class="feature-item-content"><p>{!! $feauture_item['description'] !!}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</section>