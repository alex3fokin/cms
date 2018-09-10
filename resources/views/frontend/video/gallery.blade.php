<article id="post-2417" class="post-2417 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->

    <div class="entry-content">
        {!! $data['description'] !!}
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $video_gallery_item)
                    @include($video_gallery_item->design_block->view, ['data' => $video_gallery_item->mappedInfoBlocks($locale_id)])
                @endforeach
            @endif
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-## -->