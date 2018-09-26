<section id="team" class="section-team section-padding section-meta onepage-section">
    <div class="container">
        <div class="section-title-area">
            <h5 class="section-subtitle">{!! $data['subtitle'] !!}</h5>
            <h2 class="section-title">{!! $data['title'] !!}</h2></div>

        <script type="text/javascript"> jQuery(document).ready(function () {
                jQuery(".testimonial_slider_fouc .testimonial_slider_set").show();
            });
            jQuery(document).ready(function () {
                jQuery("head").append("<style type=\"text/css\">.testimonial_slider_set.testimonial_slider{width:100% !important;max-width:100%;display:block;}.testimonial_slider_set img{max-width:90% !important;}.testimonial_side{width:100% !important;}</style>");
            });
            jQuery(document).ready(function () {
                jQuery("#testimonial_slider_recent").testiMonial({
                    responsive: true,
                    items: {width: 500, visible: {min: 1, max: 2}},
                    pagination: {
                        container: "#testimonial_slider_recent_nav", anchorBuilder: function (nr) {
                            return '<div class="inner_nav" style="width:18px;height:18px;"><a href="#" ></a></div>';
                        }
                    },
                    auto: 6000,
                    next: "#testimonial_slider_recent_next",
                    prev: "#testimonial_slider_recent_prev",
                    scroll: {items: 1, fx: "scroll", easing: "swing", duration: 600, pauseOnHover: true}
                });
                jQuery("head").append("<style type=\"text/css\">#testimonial_slider_recent_nav a.selected{background-position:-18px 0 !important;}.testimonial_slider__round .testimonial_outer_wrap:after {border-top-color: #ffffff!important;} .testimonial_slider__round .testimonial_nav-fillup .inner_nav a { border: 2px solid #999999 !important;}.testimonial_slider__round .testimonial_nav-fillup .inner_nav.selected a:after { background-color: #999999 !important; }</style>");
                jQuery("#testimonial_slider_recent_wrap").hover(function () {
                    jQuery(this).find(".testimonial_nav_arrow_wrap").show();
                }, function () {
                    jQuery(this).find(".testimonial_nav_arrow_wrap").hide();
                });
                jQuery("#testimonial_slider_recent").touchwipe({
                    wipeLeft: function () {
                        jQuery("#testimonial_slider_recent").trigger("next", 1);
                    }, wipeRight: function () {
                        jQuery("#testimonial_slider_recent").trigger("prev", 1);
                    }, preventDefaultEvents: false
                });
            });</script>
        <noscript>&lt;p&gt;&lt;strong&gt;This page is having a slideshow that uses Javascript. Your browser
            either doesn't support Javascript or you have it turned off. To see this page as it is meant to
            appear please use a Javascript enabled browser.&lt;/strong&gt;&lt;/p&gt;
        </noscript>
        <div id="testimonial_slider_recent_wrap" class="testimonial_slider testimonial_slider_set testimonial_slider__round" style="display: block;">
            <div class="testimonial_wrapper" >
                <div id="testimonial_slider_recent" class="testimonial_slider_instance" >
                    @if($design_block->children)
                        @foreach($design_block->children as $comment)
                            @php
                                $comment = $comment->mappedInfoBlocks($locale_id);
                            @endphp
                            <div class="testimonial_slideri" style="width: 555px; height: 450px;">
                                <div class="testimonial_outer_wrap" style="background-color:#ffffff;border:1px solid #03c4eb;margin-left:50px;">
                                    <div class="testimonial_avatar_wrap" style="width:110px;">
                                <span class="testimonial_avatar">
                                    <img src="{{$comment['photo']['path']}}" style="height:100px;width:100px;border:2px solid #03c4eb;border-radius: 50%;margin-left: -50px;" alt="{{$comment['photo']['alt']}}">
                                </span>
                                    </div>
                                    <div class="testimonial_by_wrap">
                                        <div class="testimonial_by_text">
                                            <span class="testimonial_by" style="line-height:21px;font-family:&#39;Lucida Sans Unicode&#39;, &#39;Lucida Grand&#39;, sans-serif;;font-size:18px;font-weight:normal;font-style:normal;color:#070000;">{!! $comment['name'] !!}</span>
                                            <span class="testimonial_site" style="line-height:17px;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:normal;font-style:normal;color:#676E73;">{!! $comment['date'] !!}</span>
                                        </div>
                                    </div>
                                    <div class="testimonial_content_wrap">
                                        <div class="testimonial_content" style="font-family:&#39;Lucida Sans Unicode&#39;, &#39;Lucida Grand&#39;, sans-serif;;font-size:14px;font-weight:normal;font-style:italic;color:#54495C;">
                                            {!! $comment['comment'] !!}
                                        </div>
                                    </div>
                                    <div class="sldr_clearlt"></div>
                                    <div class="sldr_clearrt"></div>
                                </div><!-- End Outer Wrap--><!-- /testimonial_slideri -->
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="testimonial_nav_arrow_wrap">
                <a class="testimonial_prev" id="testimonial_slider_recent_prev" href="#" style="background: url(/images/prev.png) 0px 0px no-repeat transparent; display: block;">
                    <span>prev</span>
                </a>
                <a class="testimonial_next" id="testimonial_slider_recent_next" href="#" style="background: url(/images/next.png) 0px 0px no-repeat transparent; display: block;">
                    <span>next</span>
                </a>
            </div>
            <div style="clear:left;"></div>
            <div id="testimonial_slider_recent_nav" class="testimonial_nav testimonial_nav-fillup" style="width: 161px; margin: 0px auto; display: block;">
            </div>
        </div>
        <script type="text/javascript">jQuery("html").addClass("testimonial_slider_fouc");
            jQuery(".testimonial_slider_fouc .testimonial_slider_set").hide();</script>
        <!--<div class="team-members row team-layout-4">
            </div>-->
    </div>
</section>