<div class="col-sm-6 col-lg-6">
    @if($design_block->children)
        <ul class="nav nav-tabs">
        @foreach($design_block->children as $tab)
            @php
                $tab = $tab->mappedInfoBlocks($locale_id);
            @endphp
                <li class="{{$loop->first ? 'active' : ''}}"><a href="#{{$tab['heading']}}" data-toggle="tab"><i class="icon-briefcase"></i>
                        {{$tab['heading']}}</a></li>
        @endforeach
        </ul>
        <div class="tab-content">
            @foreach($design_block->children as $tab)
                @php
                    $css = $tab->design_block->css_classes;
                    $tab = $tab->mappedInfoBlocks($locale_id);
                @endphp
                <div class="tab-pane {{$loop->first ? 'active' : ''}}" id="{{$tab['heading']}}">
                    <p>
                        @if($tab->has('image'))
                            <img src="{{$tab['image']['path']}}" class="{{$css}}" alt=""/>
                        @endif
                        {!! $tab['paragraph 1'] !!}
                    </p>
                    <p>
                        {!! $tab['paragraph 2'] !!}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>