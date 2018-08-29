<section class="callaction">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cta-text">
                    <h2>{!! $data['heading'] !!}</h2>
                    <p>{!! $data['description'] !!}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cta-btn">
                    <a href="{{$data['action refference']}}" class="btn btn-theme btn-lg">{!! $data['action sign'] !!} <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>