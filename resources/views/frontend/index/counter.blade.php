<section id="counter" class="section-counter section-padding onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['title'] !!}</h5></div>
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $counter_item)
                    @php
                        $counter_item = $counter_item->mappedInfoBlocks($locale_id);
                    @endphp
                    <div class="col-sm-6 col-md-3">
                        <div class="counter_item">
                            <div class="counter__number">
                                <span class="n-b">{!! $counter_item['before number'] !!}</span>
                                <span class="n counter">{!! $counter_item['number'] !!}</span>
                                <span class="n-a">{!! $counter_item['after number'] !!}</span>
                            </div>
                            <div class="counter_title">{!! $counter_item['title'] !!}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>