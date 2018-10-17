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
                        $blocks_contents = $about_item->blocks_contents;
                        App\Models\Backend\LocaleContent::translate($blocks_contents, $locale_id);
                        $about_item = $design_block->mapContent($blocks_contents);
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