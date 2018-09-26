<article id="post-1264" class="post-1264 page type-page status-publish hentry">
    <link rel="stylesheet" href="/css/frontend/lightgallery.min.css">
    <link rel="stylesheet" href="/css/frontend/justifiedGallery.min.css">
    <script src="/js/frontend/jquery.justifiedGallery.min.js"></script>
    <script src="/js/frontend/lightgallery.min.js"></script>
    <script src="/js/frontend/lg-thumbnail.js"></script>
    <div class="entry-content">
        @if($design_block->children)
            @foreach($design_block->children as $gallery_index => $gallery)
                @php
                    $gallery = $gallery->mappedInfoBlocks($locale_id);
                @endphp
            <div class="{{$loop->first ? '' : 'lazy-block'}}" style="margin-bottom: 15px;">
                <h3>{!! $gallery['title'] !!}</h3>
                <div id="lightgallery-{{$gallery_index}}">
                    @if($gallery['gallery'])
                        @foreach($gallery['gallery'] as $gallery_item_index => $gallery_item)
                            <a class="thumb" href="{{$gallery_item['path']}}">
                                <img src="{{$gallery_item['path']}}"/>
                            </a>
                        @endforeach
                    @endif
                </div>
                <script type="text/javascript">
                    var $animThumb_{{$gallery_index}} = jQuery('#lightgallery-{{$gallery_index}}');
                    if ($animThumb_{{$gallery_index}}.length) {
                        $animThumb_{{$gallery_index}}.justifiedGallery({
                            border: 6
                        }).on('jg.complete', function() {
                            lightGallery($animThumb_{{$gallery_index}}[0], {
                                thumbnail: true
                            });
                        });
                    };
                </script>
            </div>
            @endforeach
        @endif
    </div><!-- .entry-content -->
</article><!-- #post-## -->