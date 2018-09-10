<article id="post-2551" class="post-2551 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="gift-sertif">
            @if($design_block->children)
                @foreach($design_block->children as $design_block)
                    @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
                @endforeach
            @endif
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-## -->