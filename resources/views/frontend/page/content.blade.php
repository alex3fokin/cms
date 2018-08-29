<section class="content">
    <div class="container">
        <div class="row margintop50">
            <div class="col-lg-12">
                <h3>{!! $data['heading'] !!}</h3>
                <img src="{{$data['image']['path']}}" alt="" class="img-responsive" />
                @if($design_block->children)
                    @foreach($design_block->children as $paragraph)
                        @php
                            $paragraph = $paragraph->mappedInfoBlocks($locale_id);
                        @endphp
                        <p>
                            {!! $paragraph['text'] !!}
                        </p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>