<article id="post-2417" class="post-2417 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->

    <div class="entry-content">
        {!! $data['description'] !!}
        <div class="row">
            @if($design_block->children)
                @foreach($design_block->children as $video_gallery_item)
                    @php
                        $blocks_contents = $video_gallery_item->blocks_contents;
                        App\Models\Backend\LocaleContent::translate($blocks_contents, $locale_id);
                    @endphp
                    @include($video_gallery_item->design_block->view, ['data' => $design_block->mapContent($blocks_contents)])
                @endforeach
            @endif
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-## -->