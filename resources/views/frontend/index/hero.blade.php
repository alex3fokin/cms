<section id="hero"
         data-images="[&quot;{{$data['background image']['path']}}&quot;]"
         class="hero-slideshow-wrapper hero-slideshow-normal loaded"
         style="position: relative; z-index: 0; background: none;">
    <div class="container" style="padding-top: 10%; padding-bottom: 10%;">
        <div class="hero__content hero-content-style1">
            <h2 class="hero-large-text">{!! $data['heading'] !!} <span class="js-rotating">{!! $data['flip text'] !!}</span>
            </h2>
            <p class="hero-small-text"><br></p>                        <a
                    href="{{$data['transparent button reference']}}" class="btn btn-secondary-outline btn-lg">{!! $data['transparent button sign'] !!}</a>
            <a href="{{$data['color button reference']}}" class="btn btn-theme-primary btn-lg">{!! $data['color button sign'] !!}</a>
        </div>
    </div>
    <div class="backstretch"
         style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 686px; width: 1665px; z-index: -999998; position: absolute;">
        <img src="{{$data['background image']['path']}}"
             style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1665px; height: 1110px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -212px;">
    </div>
</section>