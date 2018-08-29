<div class="col-sm-6 col-md-6">
    <h4>{!! $title !!}</h4>
    <div class="testimonialslide clearfix flexslider">
        <ul class="slides">
            @if($design_block->children)
                @foreach($design_block->children as $feedback_item)
                    @php
                        $feedback_item = $feedback_item->mappedInfoBlocks($locale_id);
                    @endphp
                    <li>
                        <blockquote>
                            {!! $feedback_item['comment'] !!}
                        </blockquote>
                        <h4>{!! $feedback_item['name'] !!} <span>&#8213; {!! $feedback_item['company'] !!}</span></h4>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>