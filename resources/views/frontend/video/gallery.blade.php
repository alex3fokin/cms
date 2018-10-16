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
                        $data = [];
                        foreach($blocks_contents as $block_contents) {
                            $value = $block_contents->value;
                            $info_block_type = $block_contents->design_blocks_info_block->info_block->type;
                            if($info_block_type === 'media' || $info_block_type === 'media_area') {
                                $value = unserialize($value);
                            }
                            $data[$block_contents->design_blocks_info_block->title] = $value;
                        }
                    @endphp
                    @include($video_gallery_item->design_block->view, ['data' => $data])
                @endforeach
            @endif
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-## -->