<section id="about" class="section-about section-padding onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['subtitle'] !!}</h5>
            <h1 class="section-title">{!! $data['title'] !!}</h1>
            <div class="section-desc">{!! $data['description'] !!}</div>
        </div>
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $about_item)
                    @php
                        $about_item = $about_item->mappedInfoBlocks($locale_id);
                    @endphp
                    <div class="col-lg-6 col-sm-6  wow slideInUp" style="visibility: hidden; animation-name: none;">
                        <h3>{!! $about_item['heading'] !!}</h3>
                        {!! $about_item['description'] !!}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>