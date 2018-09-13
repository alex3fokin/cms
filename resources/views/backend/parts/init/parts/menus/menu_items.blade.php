<ul class="collapsible menu_items-sortable">
    @foreach($menu_items as $menu_item)
        <li data-order="{{$menu_item->order}}" data-id="{{$menu_item->id}}">
            <div class="collapsible-header">
                <div class="left">
                    {{$menu_item->title}}
                </div>
                <div class="right">
                    <button class="btn-floating waves-effect waves-light red" type="button"
                            data-id="{{$menu_item->id}}" onclick="openConfirmModal(this, 'deleteMenuItem')"><i
                                class="material-icons">delete</i></button>
                </div>
            </div>
            <div class="collapsible-body">
                <div>
                    <form onkeypress="return event.keyCode != 13;">
                        <div class="input-field col s6">
                            <label class="active" for="menu_title_{{$menu_item->id}}">Title</label>
                            <input type="text" name="menu_title_{{$menu_item->id}}" id="menu_title_{{$menu_item->id}}" value="{{$menu_item->title}}">
                        </div>
                        <div class="input-field col s6">
                            <select name="menu_item_page_id_{{$menu_item->id}}" id="menu_item_page_id_{{$menu_item->id}}">
                                <option value="" selected disabled>Choose page\category to add</option>
                                <optgroup label="Pages">
                                    @foreach($pages as $page)
                                        <option value="page_{{$page->id}}" {{$page->id == $menu_item->page_id ? 'selected' : ''}}>{{$page->title}}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Categories">
                                    @foreach($categories as $category)
                                        <option value="category_{{$category->id}}" {{$category->id == $menu_item->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <button class="btn waves-effect waves-light green" type="button" name="action"
                                data-id="{{$menu_item->id}}" onclick="updateMenuItem(this)">Save
                            <i class="material-icons right">save</i>
                        </button>
                    </form>
                    <div class="row">
                        <div class="col s12">
                            <h4 class="center-align">Add new menu item</h4>
                            <form method="POST" id="add_menu_item" onkeypress="return event.keyCode != 13;">
                                <div class="input-field col s6">
                                    <label for="child_menu_item_title_{{$menu_item->id}}">Title</label>
                                    <input type="text" name="child_menu_item_title_{{$menu_item->id}}" id="child_menu_item_title_{{$menu_item->id}}">
                                </div>
                                <div class="input-field col s6">
                                    <select id="child_menu_item_page_id_{{$menu_item->id}}">
                                        <option value="" selected disabled>Choose page\category to add</option>
                                        <optgroup label="Pages">
                                            @foreach($pages as $page)
                                                <option value="page_{{$page->id}}">{{$page->title}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Categories">
                                            @foreach($categories as $category)
                                                <option value="category_{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <button class="btn waves-effect waves-light" data-parent-id="{{$menu_item->id}}" onclick="addChildMenuItem(this)" type="button" name="action">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if(count($menu_item->children))
                        @include('backend.parts.init.parts.menus.menu_items', ['menu_items' => $menu_item->translatedChildren(($current_locale !== $default_language) ? $current_locale : null)])
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>