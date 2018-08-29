<div id="filters-container" class="cbp-l-filters-button">
    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All
        <div class="cbp-filter-counter"></div>
    </div>
    @if($design_block->children)
        @foreach($design_block->children as $portfolio_class)
            @php
                $portfolio_class = $portfolio_class->mappedInfoBlocks($locale_id);
            @endphp
            <div data-filter=".{{$portfolio_class['class']}}" class="cbp-filter-item">{!! $portfolio_class['title'] !!}
                <div class="cbp-filter-counter"></div>
            </div>
        @endforeach
    @endif
</div>