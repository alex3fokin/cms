<section id="certificates" class="certificates section-padding onepage-section">
    <h2 class="section-title">{!! $data['heading'] !!}</h2>
    <div class="gift-content">
        <div class="gift-img">
            <img src="{{$data['image']['path']}}" alt="" width="300"
                 height="196" class="alignleft size-medium wp-image-2559"></div>
        <div class="gift-article">
            {!! $data['description'] !!}
            <a href="{{$data['action reference']}}" class="btn btn-theme-primary btn-lg">{!! $data['action sign'] !!}</a>
        </div>
    </div>
</section>