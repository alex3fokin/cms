<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <h4>{!! $data['heading'] !!}</h4>
                        <p><strong>{!! $data['strong'] !!}</strong></p>
                        <p>
                            {!! $data['paragraph 1'] !!}
                        </p>
                        <p>
                            {!! $data['paragraph 2'] !!}
                        </p>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <h4>Projects</h4>
                        @if($design_block->children)
                            @foreach($design_block->children as $project_item)
                                @php
                                    $css = $project_item->design_block->css_classes;
                                    $project_item = $project_item->mappedInfoBlocks($locale_id);
                                @endphp
                                <div class="progress">
                                    <div class="progress-bar {{$css}} progress-bar-striped active"
                                         role="progressbar" aria-valuenow="{{$project_item['percent']}}" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{$project_item['percent']}}%">
                                        {!! $project_item['sign'] !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>