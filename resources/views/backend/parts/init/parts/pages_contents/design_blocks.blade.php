<ul class="collapsible pages-sortable">
    @foreach($pages_current_design_blocks as $design_block)
        @if($design_block->is_widget)
            <li data-order="{{$design_block->order}}" data-id="{{$design_block->id}}">
                <div class="collapsible-header collapsible-disabled">
                    <div class="left">
                        {{$design_block->widget->title}}
                    </div>
                    <div class="right">
                        <button class="btn-floating waves-effect waves-light red" type="button"
                                data-id="{{$design_block->id}}" onclick="deletePageDesignBlock(this)"><i
                                    class="material-icons">delete</i></button>
                    </div>
                </div>
            </li>
        @else
            <li data-order="{{$design_block->order}}" data-id="{{$design_block->id}}">
                <div class="collapsible-header">
                    <div class="left">
                        {{$design_block->design_block->title}}
                    </div>
                    <div class="right">
                        <button class="btn-floating waves-effect waves-light red" type="button"
                                data-id="{{$design_block->id}}" onclick="deletePageDesignBlock(this)"><i
                                    class="material-icons">delete</i></button>
                    </div>
                </div>
                <div class="collapsible-body">
                    @if(count($design_block->pages_blocks_contents))
                        <form onkeypress="return event.keyCode != 13;">
                            @foreach($design_block->pages_blocks_contents as $page_block_content)
                                @include('backend.info_blocks_inputs.'.$page_block_content->design_blocks_info_block->info_block->type, ['data' => $page_block_content->getInputData(($current_locale !== $default_language) ? $current_locale : null)])
                            @endforeach
                            <button class="btn waves-effect waves-light green" type="button" name="action"
                                    onclick="updatePageDesignBlockContent(this)">Save
                                <i class="material-icons right">save</i>
                            </button>
                        </form>
                    @endif
                    @if(count($design_block->children))
                        @include('backend.parts.init.parts.pages_contents.design_blocks', ['pages_current_design_blocks' => $design_block->children])
                    @endif
                    @if($design_block->design_block->children)
                        <div class="row">
                            <div class="col s10">
                                <select id="page_children_design_blocks_select_{{$design_block->id}}">
                                    <option value="" selected disabled>Choose design block to add</option>
                                    @foreach($design_block->design_block->children as $possible_design_blocks)
                                        <option value="{{$possible_design_blocks->title}}">{{$possible_design_blocks->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col s2">
                                <button class="btn waves-effect waves-light" type="button" name="action"
                                        data-parent-id="{{$design_block->id}}" onclick="addPageChildrenDesignBlock(this)">
                                    Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </li>
        @endif
    @endforeach
</ul>