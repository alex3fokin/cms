<article id="post-1264" class="post-1264 page type-page status-publish hentry">
    <header class="entry-header">
    </header><!-- .entry-header -->
    <link rel="stylesheet" id="envira-gallery-style-css" href="/css/frontend/envira.css" type="text/css" media="all"
          property="stylesheet">
    <link rel="stylesheet" id="envira-gallery-jgallery-css" href="/css/frontend/justifiedGallery.css" type="text/css" media="all"
          property="stylesheet">
    <link rel="stylesheet" id="envira-gallerybase_dark-theme-css" href="/css/frontend/style(2).css" type="text/css" media="all"
          property="stylesheet">
    <link rel="stylesheet" id="envira-videos-style-css" href="/css/frontend/envira-videos.css" type="text/css" media="all"
          property="stylesheet">
    <link rel="stylesheet" id="envira-gallery-supersize-style-css" href="/css/frontend/envira-supersize.css" type="text/css"
          media="all" property="stylesheet">
    <script type="text/javascript" src="/js/frontend/envira-min.js"></script>
    <script src="/js/frontend/lazyload.min.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var myLazyLoad = new LazyLoad({
                elements_selector: ".lazy"
            });
        });
        var envira_galleries = [], envira_gallery_images = {}, envira_isotopes = [], envira_isotopes_config = [],
        envira_gallery_sort = {}, envira_gallery_options = {};
    </script>
    <div class="entry-content">
        @if($design_block->children)
            @foreach($design_block->children as $gallery_index => $gallery)
                @php
                    $gallery = $gallery->mappedInfoBlocks($locale_id);
                    $noscript = "<noscript>";
                @endphp
                <h3>{!! $gallery['title'] !!}</h3>
                <script>
                    jQuery(document).ready(function ($) {
                        var envira_container_{{$gallery_index}} = '';
                        $('#envira-gallery-{{$gallery_index}}').enviraJustifiedGallery({
                            rowHeight: 150,
                            maxRowHeight: -1,
                            selector: '> div > div',
                            lastRow: 'nojustify',
                            border: 0,
                            margins: 1,
                        });
                        $('#envira-gallery-{{$gallery_index}}').css('opacity', '1');
                        envira_container_{{$gallery_index}} = $('#envira-gallery-{{$gallery_index}}').enviraImagesLoaded(function () {
                            $('.envira-gallery-item img').fadeTo('slow', 1);
                        });
                        envira_gallery_options['{{$gallery_index}}'] = {
                            lightboxTheme: 'base_dark',
                            margin: 0,
                            padding: 0,
                            autoCenter: true,
                            arrows: true,
                            aspectRatio: 1,
                            loop: 1,
                            mouseWheel: 1,
                            preload: 1,
                            openEffect: 'fade',
                            closeEffect: 'fade',
                            nextEffect: 'fade',
                            prevEffect: 'fade',
                            tpl: {
                                wrap: '<div class="envirabox-wrap" tabIndex="-1"><div class="envirabox-skin envirabox-theme-base_dark"><div class="envirabox-outer"><div class="envirabox-inner"><div class="envirabox-actions base_dark "><div class="envira-close-button"><a title="Закрыть" class="envirabox-item envira-close" href="#"></a></div></div><div class="envirabox-position-overlay envira-gallery-top-left"></div><div class="envirabox-position-overlay envira-gallery-top-right"></div><div class="envirabox-position-overlay envira-gallery-bottom-left"></div><div class="envirabox-position-overlay envira-gallery-bottom-right"></div></div></div></div></div>',
                                image: '<img class="envirabox-image" src="{href}" alt="" data-envira-title="" data-envira-caption="" data-envira-index="" data-envira-data="" />',
                                iframe: '<iframe id="envirabox-frame{rnd}" name="envirabox-frame{rnd}" class="envirabox-iframe" frameborder="0" vspace="0" hspace="0" allowtransparency="true" wekitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                                error: '<p class="envirabox-error">Запрошенный контент не может быть загружен.<br/>Пожалуйста, попробуйте еще раз позже.</p>',
                                closeBtn: '<a title="Закрыть" class="envirabox-item envirabox-close" href="#"></a>',
                                next: '<a title="След." class="envirabox-nav envirabox-next envirabox-arrows-inside envirabox-nav-base_dark " href="#"><span></span></a>',
                                prev: '<a title="Пред." class="envirabox-nav envirabox-prev envirabox-arrows-inside envirabox-nav-base_dark " href="#"><span></span></a>'
                            },
                            helpers: {
                                video: {autoplay: 0, playpause: 1, progress: 1, current: 1, duration: 1, volume: 1,},
                                title: {type: 'fixed', alwaysShow: '1',},
                                thumbs: {
                                    width: 75,
                                    height: 50,
                                    mobile_thumbs: 1,
                                    mobile_width: 75,
                                    mobile_height: 50,
                                    source: function (current) {
                                        if (typeof current.element == 'undefined') {
                                            return current.thumbnail;
                                        } else {
                                            return $(current.element).data('thumbnail');
                                        }
                                    },
                                    mobileSource: function (current) {
                                        if (typeof current.element == 'undefined') {
                                            return current.mobile_thumbnail;
                                        } else {
                                            return $(current.element).data('mobile-thumbnail');
                                        }
                                    },
                                    dynamicMargin: true,
                                    dynamicMarginAmount: 0,
                                    position: 'bottom',
                                },
                                slideshow: {skipSingle: true},
                                navDivsRoot: false,
                                actionDivRoot: false,
                            },
                            beforeLoad: function () {
                                this.title = $(this.element).attr('data-envira-caption');
                            },
                            afterLoad: function () {
                                $('.envirabox-overlay-fixed').on({
                                    'touchmove': function (e) {
                                        e.preventDefault();
                                    }
                                });
                            },
                            beforeShow: function () {
                                $(window).on({
                                    'resize.envirabox': function () {
                                        $.envirabox.update();
                                    }
                                });
                                if (typeof this.element === 'undefined') {
                                    var gallery_id = this.group[this.index].gallery_id;
                                    var gallery_item_id = this.group[this.index].id;
                                    var alt = this.group[this.index].alt;
                                    var title = this.group[this.index].title;
                                    var caption = this.group[this.index].caption;
                                    var index = this.index;
                                } else {
                                    var gallery_id = this.element.find('img').data('envira-gallery-id');
                                    var gallery_item_id = this.element.find('img').data('envira-item-id');
                                    var alt = this.element.find('img').attr('alt');
                                    var title = this.element.find('img').parent().attr('title');
                                    var caption = this.element.find('img').parent().data('envira-caption');
                                    var retina_image = this.element.find('img').parent().data('envira-retina');
                                    var index = this.element.find('img').data('envira-index');
                                    var src = this.element.find('img').attr('src');
                                    var full_sized_image = this.element.find('img').attr('data-envira-fullsize-src');
                                }
                                this.inner.find('img').attr('alt', alt).attr('data-envira-gallery-id', gallery_id).attr('data-envira-fullsize-src', full_sized_image).attr('data-envira-item-id', gallery_item_id).attr('data-envira-title', title).attr('data-envira-caption', caption).attr('data-envira-index', index);
                                $('.envirabox-wrap').attr('alt', alt).attr('data-envira-gallery-id', gallery_id).attr('data-envira-fullsize-src', full_sized_image).attr('data-envira-item-id', gallery_item_id).attr('data-envira-title', title).attr('data-envira-caption', caption).attr('data-envira-index', index).attr('data-envira-src', src);
                                if (typeof retina_image !== 'undefined' && retina_image !== '') {
                                    this.inner.find('img').attr('srcset', retina_image + ' 2x');
                                }
                                $('.envirabox-overlay').addClass('overlay-base_dark');
                                $('.envirabox-overlay').addClass('overlay-video');
                                $('.envirabox-overlay').addClass('envirabox-thumbs');
                                var video_aspect_ratio;
                                if (typeof this.element === 'undefined') {
                                    if (this.group[this.index].video_aspect_ratio !== 'undefined') {
                                        video_aspect_ratio = this.group[this.index].video_aspect_ratio;
                                    } else {
                                        video_aspect_ratio = '';
                                    }
                                } else {
                                    video_aspect_ratio = this.element.data('video-aspect-ratio');
                                }
                                if (typeof video_aspect_ratio !== 'undefined' && video_aspect_ratio == '16:9') {
                                    this.width = 960;
                                    this.height = 540;
                                }
                                var overlay_supersize = true;
                                if (overlay_supersize) {
                                    $('.envirabox-overlay').addClass('overlay-supersize');
                                    $('#envirabox-thumbs').addClass('thumbs-supersize');
                                }
                                $('.envira-close').click(function (event) {
                                    event.preventDefault();
                                    $.envirabox.close();
                                });
                            },
                            afterShow: function () {
                                if ($('#envirabox-thumbs ul li').length > 0) {
                                    $('#envirabox-thumbs').swipe({
                                        excludedElements: ".noSwipe",
                                        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                                            if (direction === 'left' && fingerCount <= 1) {
                                                $.envirabox.next(direction);
                                            } else if (direction === 'left' && fingerCount > 1) {
                                                $.envirabox.jumpto(0);
                                            } else if (direction === 'right' && fingerCount <= 1) {
                                                $.envirabox.prev(direction);
                                            } else if (direction === 'right' && fingerCount > 1) {
                                                $.envirabox.jumpto(sizeof($('#envirabox-thumbs ul li').length));
                                            }
                                        }
                                    });
                                }
                                $('.envirabox-wrap, .envirabox-wrap a.envirabox-nav').swipe({
                                    excludedElements: "label, button, input, select, textarea, .noSwipe",
                                    swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                                        if (direction === 'left') {
                                            $.envirabox.next(direction);
                                        } else if (direction === 'right') {
                                            $.envirabox.prev(direction);
                                        } else if (direction === 'up') {
                                        }
                                    }
                                });
                                var overlay_supersize = true;
                                if (overlay_supersize) {
                                    $('#envirabox-thumbs').addClass('thumbs-supersize');
                                }
                            },
                            beforeClose: function () {
                            },
                            afterClose: function () {
                                $(window).off('resize.envirabox');
                            },
                            onUpdate: function () {
                            },
                            onCancel: function () {
                            },
                            onPlayStart: function () {
                            },
                            onPlayEnd: function () {
                            }
                        };
                        envira_galleries['{{$gallery_index}}'] = $('.envira-gallery-{{$gallery_index}}').envirabox(envira_gallery_options['{{$gallery_index}}']);
                    });
                </script>
                <div id="envira-gallery-wrap-{{$gallery_index}}"
                     class="envira-gallery-wrap envira-gallery-theme-base envira-lightbox-theme-base_dark" itemscope=""
                     itemtype="http://schema.org/ImageGallery">
                    <div style="opacity: 1;" data-row-height="150" data-justified-margins="1"
                         data-gallery-theme="normal" id="envira-gallery-{{$gallery_index}}"
                         class="envira-gallery-public envira-gallery-justified-public envira-gallery-0-columns envira-clear envira-gallery-css-animations envira-justified-gallery"
                         data-envira-columns="0">
                        @if($gallery['gallery'])
                            @foreach($gallery['gallery'] as $gallery_item_index => $gallery_item)
                                @php
                                    $noscript .= "<img src='".$gallery_item['path']."' alt ='".$gallery_item['alt']."'>";
                                @endphp
                                <div id="envira-gallery-item-{{$gallery_item_index}}"
                                     class="envira-gallery-item enviratope-item envira-gallery-item-{{$gallery_item_index}}"
                                     style="padding-left: 5px; padding-bottom: 10px; padding-right: 5px;" itemscope=""
                                     itemtype="http://schema.org/ImageObject">
                                    <div class="envira-gallery-item-inner jg-entry"
                                         style="top: 0px; left: 0px; opacity: 1;">
                                        <div class="envira-gallery-position-overlay  envira-gallery-top-left"></div>
                                        <div class="envira-gallery-position-overlay  envira-gallery-top-right"></div>
                                        <div class="envira-gallery-position-overlay  envira-gallery-bottom-left"></div>
                                        <div class="envira-gallery-position-overlay  envira-gallery-bottom-right"></div>
                                        <a href="{{$gallery_item['path']}}"
                                           class="envira-gallery-{{$gallery_index}} envira-gallery-link "
                                           rel="enviragallery{{$gallery_index}}" title="{{$gallery_item['alt']}}"
                                           data-envira-caption="{{$gallery_item['alt']}}" data-envira-retina=""
                                           data-thumbnail="{{$gallery_item['path']}}"
                                           data-mobile-thumbnail="{{$gallery_item['path']}}" itemprop="contentUrl">
                                            <img id="envira-gallery-image-{{$gallery_item_index}}"
                                                 class="envira-gallery-image envira-lazy envira-gallery-image-{{$gallery_item_index}} envira-normal lazy"
                                                 data-envira-index="{{$gallery_item_index}}" data-src="{{$gallery_item['path']}}"
                                                 data-envira-src="{{$gallery_item['path']}}"
                                                 data-envira-gallery-id="{{$gallery_index}}"
                                                 data-envira-item-id="{{$gallery_item_index}}" data-envira-caption=""
                                                 alt="" title="{{$gallery_item['alt']}}" itemprop="thumbnailUrl"
                                                 style="margin-left: -79px; margin-top: -79px; opacity: 1;">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                {!! $noscript.'</noscript>' !!}
            @endforeach
        @endif
    </div><!-- .entry-content -->
</article><!-- #post-## -->