<section id="services" class="section-services section-padding section-meta onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['subtitle'] !!}</h5>
            <h2 class="section-title">{!! $data['title'] !!}</h2></div>
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $service)
                    @php
                        $blocks_contents = $service->blocks_contents;
                        App\Models\Backend\LocaleContent::translate($blocks_contents, $locale_id);
                        $data = [];
                        foreach($blocks_contents as $block_contents) {
                            $value = $block_contents->value;
                            $info_block_type = $block_contents->design_blocks_info_block->info_block->type;
                            if($info_block_type === 'media' || $info_block_type === 'media_area') {
                                $value = unserialize($value);
                            }
                            $data[$block_contents->design_blocks_info_block->title] = $value;
                        }
                        $service = $data;
                    @endphp
                    <div class="col-sm-6 col-lg-6 wow slideInUp" style="visibility: hidden; animation-name: none;">
                        <div class="service-item ">
                            <a class="service-link" href="{{$service['reference']}}"><span
                                        class="screen-reader-text">{!! $service['heading'] !!}</span></a>
                            <div class="service-image"><i class="fa fa fa-{{$service['icon']}} fa-5x"></i></div>
                            <div class="service-content">
                                <h4 class="service-title">{!! $service['heading'] !!}</h4>
                                {!! $service['description'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>