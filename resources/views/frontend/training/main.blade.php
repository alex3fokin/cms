<article id="post-54" class="post-54 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->

    <div class="entry-content">
        @if($design_block->children)
            @foreach($design_block->children as $design_block)
                @php
                    $blocks_contents = $design_block->blocks_contents;
                    App\Models\Backend\LocaleContent::translate($blocks_contents, $locale_id);
                @endphp
                @include($design_block->design_block->view, ['data' => $design_block->mapContent($blocks_contents)])
            @endforeach
        @endif
    </div><!-- .entry-content -->
</article><!-- #post-## -->