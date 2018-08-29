<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">{!! $data['heading'] !!}</h4>
            </div>
            @if($design_block->children)
                @foreach($design_block->children as $price_item)
                    @php
                        $css = $price_item->design_block->css_classes;
                        $price_children = $price_item->children;
                        $price_item = $price_item->mappedInfoBlocks($locale_id);
                    @endphp
                    <div class="col-lg-3 {{$css}}">
                        <div class="pricing-box-alt">
                            <div class="pricing-heading">
                                <h3>{!! $price_item['heading'] !!}</h3>
                            </div>
                            <div class="pricing-terms">
                                <h6>{!! $price_item['price'] !!}</h6>
                            </div>
                            <div class="pricing-content">
                                @if($price_children)
                                    <ul>
                                    @foreach($price_children as $price_feature)
                                        @php
                                            $price_feature = $price_feature->mappedInfoBlocks($locale_id);
                                        @endphp
                                            <li><i class="icon-ok"></i> {!! $price_feature['title'] !!}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="pricing-action">
                                <a href="{{$price_item['action refference']}}" class="btn btn-medium btn-theme"><i class="icon-bolt"></i> {!! $price_item['action sign'] !!}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>