<section id="gallery" class="section-gallery section-padding section-meta onepage-section">
    <div class="g-layout-full-width container">
        <div class="section-title-area">
            <h2 class="section-title">{!! $data['title'] !!}</h2>
            <div class="section-desc"><p>{!! $data['subtitle'] !!}</p>
            </div>
        </div>
        <div class="gallery-content">
            <div data-col="6" class="g-zoom-in gallery-masonry  enable-lightbox  gallery-grid g-col-6">
                @foreach($data['gallery'] as $photo)
                    <a href="{{$photo['path']}}" class="g-item" title="{{$photo['alt']}}">
                    <span class="inner">
                        <span class="inner-content">
                            <img src="{{$photo['path']}}" alt="{{$photo['alt']}}">
                        </span>
                    </span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="all-gallery">
            <a class="btn btn-theme-primary-outline" href="{{$data['action reference']}}">{!! $data['action sign'] !!}</a>
        </div>

    </div>
</section>