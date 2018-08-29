<div id="grid-container" class="cbp-l-grid-projects">
    @if($design_block->children)
        <ul>
        @foreach($design_block->children as $portfolio_item)
            @php
                $portfolio_item = $portfolio_item->mappedInfoBlocks($locale_id);
            @endphp
                <li class="cbp-item {{$portfolio_item['class']}}">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="{{$portfolio_item['thumbnail']['path']}}" alt=""/>
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    <a href="{{$portfolio_item['image']['path']}}"
                                       class="cbp-lightbox cbp-l-caption-buttonRight"
                                       data-title="{!! $portfolio_item['title'] !!}">view larger</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title">{!! $portfolio_item['thumbnail title'] !!}</div>
                    <div class="cbp-l-grid-projects-desc">{!! $portfolio_item['thumbnail description'] !!}</div>
                </li>
        @endforeach
        </ul>
    @endif
</div>