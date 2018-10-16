<section id="counter" class="section-counter section-padding onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['title'] !!}</h5></div>
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $counter_item)
                    @php
                        $blocks_contents = $counter_item->blocks_contents;
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
                        $counter_item = $data;
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