<section class="content">
    @if($design_block->children)
        @foreach($design_block->children as $design_block)
            @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
        @endforeach
    @endif
</section>