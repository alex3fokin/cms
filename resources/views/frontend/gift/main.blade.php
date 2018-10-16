<article id="post-2551" class="post-2551 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="gift-sertif">
            @if($design_block->children)
                @foreach($design_block->children as $design_block)
                    @php
                        $blocks_contents = $design_block->blocks_contents;
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
                    @include($design_block->design_block->view, ['data' => $data])
                @endforeach
            @endif
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-## -->