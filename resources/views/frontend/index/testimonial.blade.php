<section class="content">
    <div class="container testimotional-block">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @php
                        $title = $data['heading'];
                    @endphp
                    @if($design_block->children)
                        @foreach($design_block->children as $design_block)
                            @include($design_block->design_block->view, ['data' => $design_block->mappedInfoBlocks($locale_id)])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>