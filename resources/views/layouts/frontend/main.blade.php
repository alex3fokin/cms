<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$general_info['Title']}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Bootstrap 3 template for corporate business"/>
    <meta name="author" content="http://iweb-studio.com"/>
    <!-- css -->
    <link href="/css/frontend/bootstrap.min.css" rel="stylesheet"/>
    <link href="/plugins/flexslider/flexslider.css" rel="stylesheet" media="screen"/>
    <link href="/css/frontend/cubeportfolio.min.css" rel="stylesheet"/>
    <link href="/css/frontend/style.css" rel="stylesheet"/>

    <!-- Theme skin -->
    <link id="t-colors" href="/skins/default.css" rel="stylesheet"/>

    <!-- boxed bg -->
    <link id="bodybg" href="/bodybg/bg1.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
    <!-- start header -->
    <header>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="topleft-info">
                            <li><i class="fa fa-phone"></i> {{$general_info['Phone number 1']}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div id="sb-search" class="sb-search">
                            <form>
                                <input class="sb-search-input" placeholder="Enter your search term..." type="text"
                                       value="" name="search" id="search">
                                <input class="sb-search-submit" type="submit" value="">
                                <span class="sb-icon-search" title="Click to start searching"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="" width="199" height="52"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        @php
                            $current_active_page_menu_item = $page->menu_item;
                            if(is_null($current_active_page_menu_item->parent_menu)) {
                                  $current_active_menu = $current_active_page_menu_item->title;
                            } else {
                                  $current_active_menu = $current_active_page_menu_item->main_parent->title;
                            }
                        @endphp
                        @foreach($menus['top menu']->menu_items as $menu_item)
                            @php
                                $url = $menu_item->page ? $menu_item->page->url : '#';
                            @endphp
                            @if(count($menu_item->children))
                                <li class="dropdown {{$current_active_menu === $menu_item->title ? 'active' : ''}}">
                                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">{{$menu_item->title}} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        @foreach($menu_item->children as $menu_item)
                                            @php
                                                $url = $menu_item->page ? $menu_item->page->url : '#';
                                            @endphp
                                            @if(count($menu_item->children))
                                                <li class="dropdown-submenu">
                                                    <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown">Pages</a>
                                                    <ul class="dropdown-menu">
                                                        @foreach($menu_item->children as $menu_item)
                                                            @php
                                                                $url = $menu_item->page ? $menu_item->page->url : '#';
                                                            @endphp
                                                        @endforeach
                                                        <li><a href="/{{$url}}{{request()->lang ? '?lang='.request()->lang : ''}}">{{$menu_item->title}}</a></li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="/{{$url}}{{request()->lang ? '?lang='.request()->lang : ''}}">{{$menu_item->title}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="{{$current_active_menu === $menu_item->title ? 'active' : ''}}"><a href="/{{$url}}{{request()->lang ? '?lang='.request()->lang : ''}}">{{$menu_item->title}}</a></li>
                            @endif
                        @endforeach
                        <li>
                            <select id="locale_select" class="form-control">
                                @foreach($locales as $locale)
                                    <option value="{{$locale->id}}" {{intval($locale->id) === intval($locale_id) ? 'selected' : ''}}>{{$locale->title}}</option>
                                @endforeach
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    @foreach($page->design_blocks as $design_block)
        @if($design_block->is_widget)
            @foreach($design_block->widget->design_blocks as $design_block)
                @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
            @endforeach
        @else
            @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
        @endif
    @endforeach
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-lg-3">
                    <div class="widget">
                        <h4>Get in touch with us</h4>
                        <address>
                            {!! $general_info['Address'] !!}
                        </address>
                        <p>
                            <i class="icon-phone"></i> {{$general_info['Phone number 2']}} - {{$general_info['Phone number 3']}} <br>
                            <i class="icon-envelope-alt"></i> {{$general_info['Email']}}
                        </p>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="widget">
                        <h4>Information</h4>
                        <ul class="link-list">
                            <li><a href="#">Press release</a></li>
                            <li><a href="#">Terms and conditions</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Career center</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="widget">
                        <h4>Pages</h4>
                        <ul class="link-list">
                            <li><a href="#">Press release</a></li>
                            <li><a href="#">Terms and conditions</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Career center</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="widget">
                        <h4>Newsletter</h4>
                        <p>Fill your email and sign up for monthly newsletter to keep updated</p>
                        <div class="form-group multiple-form-group input-group">
                            <input type="email" name="email" class="form-control">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-theme btn-add">Subscribe</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
							<span>&copy; Sailor 2015 All right reserved. | <a href="http://bootstraptaste.com/">Bootstrap Themes</a> by BootstrapTaste
                            </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="social-network">
                            <li><a href="{{$general_info['Facebook']}}" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="{{$general_info['Twitter']}}" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{$general_info['Linkedin']}}" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li><a href="{{$general_info['Pinterest']}}" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            </li>
                            <li><a href="{{$general_info['Google plus']}}" data-placement="top" title="Google plus"><i
                                            class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/frontend/jquery.min.js"></script>
<script src="/js/frontend/modernizr.custom.js"></script>
<script src="/js/frontend/jquery.easing.1.3.js"></script>
<script src="/js/frontend/bootstrap.min.js"></script>
<script src="/plugins/flexslider/jquery.flexslider-min.js"></script>
<script src="/plugins/flexslider/flexslider.config.js"></script>
<script src="/js/frontend/jquery.appear.js"></script>
<script src="/js/frontend/stellar.js"></script>
<script src="/js/frontend/classie.js"></script>
<script src="/js/frontend/uisearch.js"></script>
<script src="/js/frontend/jquery.cubeportfolio.min.js"></script>
<script src="/js/frontend/google-code-prettify/prettify.js"></script>
<script src="/js/frontend/animate.js"></script>
<script src="/js/frontend/custom.js"></script>
<script>
    $(document).ready(function() {
        $('#locale_select').change(function() {
            console.log($(this).val());
            window.location = window.location.origin + window.location.pathname + '?lang=' + $(this).val();
        });
    });
</script>
</body>
</html>