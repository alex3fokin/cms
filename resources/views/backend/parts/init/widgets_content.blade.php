<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12">
                <select id="widget_locale_select_id">
                    @foreach($locales as $locale)
                        <option value="{{$locale->id}}" {{intval($current_locale) === intval($locale->id) ? "selected" : ''}}>{{$locale->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <ul class="collapsible">
            @foreach($widgets as $widget)
            <li>
                <div class="collapsible-header">{{$widget->title}}</div>
                <div class="collapsible-body">
                    @include('backend.parts.init.parts.widgets_content.design_blocks', ['widgets_current_design_blocks' => $widget->design_blocks, 'is_sortable' => false])
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@push('after-scripts')
    <script>
        function updateWidgetDesignBlockContent(elem) {
            console.log($(elem).parent().serialize());
            var data = $(':not(textarea[class~="wysiwyg-textarea"])', $(elem).parent()).serialize();
            $(elem).parent().find('textarea[class~="wysiwyg-textarea"]').each(function() {
                data += '&'+$(this).attr('name')+'='+CKEDITOR.instances[$(this).attr('id')].getData();
            });
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{!! route('api.widget_content.update') !!}',
                data: data + '&locale_id={{$current_locale}}',
                success: function(data) {
                    console.log(data);
                },
                error:function(data) {
                    console.log(data);
                }
            });
        }

        function deleteWidgetChildrenDesignBlock(elem) {
            var id = $(elem).data('id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.design_block.delete')}}',
                data: {id: id, _method: 'DELETE'},
                success:function(data) {
                    console.log(data);
                    window.location.reload();
                },
                error:function(data) {
                    console.log(data);
                }
            });
        }

        function addWidgetChildrenDesignBlock(elem) {
            var id = $(elem).data('parent-id');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('api.widget.design_block.add')}}',
                data: {parent_design_block: id, design_block: $('#widget_children_design_blocks_select_' + id).val()},
                success: function(data){
                    console.log(data);
                    window.location.reload();
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        $(document).ready(function() {
            $('#widget_locale_select_id').change(function() {
                window.location = window.location.origin + window.location.pathname + '?locale_id=' + $(this).val();
            });

            $('.collapsible').collapsible();
            $('.widget-sortable').sortable({
                stop: function( event, ui ) {
                    var elements = $(ui.item).parent().children();
                    var order = [];
                    console.log(elements);
                    var length = elements.length;
                    for(i = 0; i < length; i++) {
                        if(!$(elements[i]).hasClass('ui-sortable-placeholder')) {
                            order.push({id: $(elements[i]).data('id'), order: (i+1)});
                        }
                    }
                    console.log(order);
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('api.widget.design_blocks.order.update')}}',
                        data: {order: order},
                        success: function (data) {
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        });
    </script>
@endpush