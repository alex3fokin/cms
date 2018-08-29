<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2>{!! $data['heading'] !!}</h2>
                    <p>{!! $data['description'] !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if($design_block->children)
                        @foreach($design_block->children as $feature)
                            @php
                                $feature = $feature->mappedInfoBlocks($locale_id)
                            @endphp
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="box">
                                    <div class="aligncenter">
                                        <div class="icon">
                                            <i class="fa fa-{{$feature['icon']}} fa-5x"></i>
                                        </div>
                                        <h4>{!! $feature['sign'] !!}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>