<ul class="collapsible {{$is_sortable ? 'widget-sortable' : ''}}">
    @foreach($widgets_current_design_blocks as $design_block)
        <li data-order="{{$design_block->order}}" data-id="{{$design_block->id}}">
            <div class="collapsible-header justify-content-between">
                <div class="left">
                    {{$design_block->design_block->title}}
                </div>
                @if($is_sortable && $can_delete)
                    <div class="right">
                        <button class="btn-floating waves-effect waves-light red" type="button"
                                data-id="{{$design_block->id}}"
                                onclick="openConfirmModal(this, 'deleteWidgetChildrenDesignBlock')"><i
                                    class="material-icons">delete</i></button>
                    </div>
                @endif
            </div>
            <div class="collapsible-body">
                @if(count($design_block->widgets_blocks_contents))
                    <div class="row">
                        <h5 class="center-align">Element content</h5>
                        <form class="form_design_block" onkeypress="return event.keyCode != 13;">
                            @foreach($design_block->widgets_blocks_contents as $widget_block_content)
                                @include('backend.info_blocks_inputs.'.$widget_block_content->design_blocks_info_block->info_block->type, ['data' => $widget_block_content->getInputData(($current_locale !== $default_language) ? $current_locale : null)])
                            @endforeach
                        </form>
                    </div>
                @endif
                @if(count($design_block->children))
                    <h5 class="center-align">Nested elements</h5>
                    @include('backend.parts.widgets.widget_edit.design_blocks', ['widgets_current_design_blocks' => $design_block->children, 'is_sortable' => true, 'can_delete' => true])
                @endif
                @if($design_block->design_block->children)
                    <div class="row">
                        <div class="col s12">
                            <h5 class="center-align">Add new nested element</h5>
                        </div>
                        <div class="col s11">
                            <select id="widget_children_design_blocks_select_{{$design_block->id}}">
                                <option value="" selected disabled>Choose design block to add</option>
                                @foreach($design_block->design_block->children as $possible_design_blocks)
                                    <option value="{{$possible_design_blocks->title}}">{{$possible_design_blocks->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s1">
                            <button class="btn-floating waves-effect waves-light green tooltipped" type="button" name="action"
                                    data-parent-id="{{$design_block->id}}" onclick="addWidgetChildrenDesignBlock(this)"
                            data-position="top" data-tooltip="Add new nested element">
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>