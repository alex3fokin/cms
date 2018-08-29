<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{$data['heading']}}</h4>
                @if($design_block->children)
                    @foreach($design_block->children as $design_block)
                        @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>