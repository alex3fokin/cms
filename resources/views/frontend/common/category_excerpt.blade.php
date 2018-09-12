<article id="post-2738" class="list-article clearfix post-2738 post type-post status-publish format-standard has-post-thumbnail hentry category-school">
    <div class="list-article-thumb">
        <a href="/{{$category_page->page->url}}">
            <img width="300" height="150" src="{{$data['image']['path']}}"
                 class="attachment-onepress-blog-small size-onepress-blog-small wp-post-image"
                 alt="">
        </a>
    </div>

    <div class="list-article-content">
        <div class="list-article-meta">
            @foreach($category_page->page->categories as $category)
                @if(!$loop->first)
                /
                @endif
                <a href="/{{$category->url}}" rel="category tag">{{$category->title}}</a>
            @endforeach
        </div>
        <header class="entry-header">
            <h2 class="entry-title"><a
                        href="/{{$category_page->page->url}}"
                        rel="bookmark">{{$category_page->page->title}}</a></h2>
        </header><!-- .entry-header -->
        <div class="entry-excerpt">
            {!! $data['excerpt'] !!}
        </div><!-- .entry-content -->
    </div>

</article><!-- #post-## -->