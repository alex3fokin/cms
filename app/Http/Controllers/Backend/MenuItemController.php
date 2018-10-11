<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DefaultData;
use App\Models\Backend\LocaleContent;
use App\Models\Backend\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Adapter\Local;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request)
    {
        $v = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menus,id',
            'page_id' => [
                'sometimes',
                'nullable',
                function ($attribute, $value, $fail) {
                $value = explode('_', $value);
                $entity = $value[0];
                $entity = ucfirst($entity);
                $entity = 'App\Models\Backend\\'.$entity.'\\'.$entity;
                $id = $value[1];
                    if (!$entity::where('id', $id)->exists($id)) {
                        return $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'title' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $i = MenuItem::where([['parent_menu', null], ['menu_id', $request->menu_id]])->max('order') ?? 0;
        $entity = explode('_', $request->page_id)[0] . '_id';
        $id = explode('_', $request->page_id)[1];
        return response()->json(['menu_item' => MenuItem::create([
            'title' => $request->title,
            'menu_id' => $request->menu_id,
            $entity => $id,
            'order' => ++$i,
        ])], 200);
    }

    public function addChild(Request $request)
    {
        $v = Validator::make($request->all(), [
            'parent_menu' => 'required|exists:menu_items,id',
            'menu_id' => 'required|exists:menus,id',
            'page_id' => [
                'sometimes',
                'nullable',
                function ($attribute, $value, $fail) {
                    $value = explode('_', $value);
                    $entity = $value[0];
                    $entity = ucfirst($entity);
                    $entity = 'App\Models\Backend\\'.$entity.'\\'.$entity;
                    $id = $value[1];
                    if (!$entity::where('id', $id)->exists($id)) {
                        return $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'title' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $i = MenuItem::where([['parent_menu', $request->parent_menu], ['menu_id', $request->menu_id]])->max('order') ?? 0;
        $entity = explode('_', $request->page_id)[0] . '_id';
        $id = explode('_', $request->page_id)[1];
        return response()->json(['menu_item' => MenuItem::create([
            'title' => $request->title,
            'parent_menu' => $request->parent_menu,
            'menu_id' => $request->menu_id,
            $entity => $id,
            'order' => ++$i,
        ])], 200);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:menu_items,id',
            'page_id' => [
                'sometimes',
                'nullable',
                function ($attribute, $value, $fail) {
                    $value = explode('_', $value);
                    $entity = $value[0];
                    $entity = ucfirst($entity);
                    $entity = 'App\Models\Backend\\'.$entity.'\\'.$entity;
                    $id = $value[1];
                    if (!$entity::where('id', $id)->exists($id)) {
                        return $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'title' => 'required',
            'locale_id' => 'sometimes|nullable|exists:locales,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        $entity = explode('_', $request->page_id)[0] . '_id';
        $id = explode('_', $request->page_id)[1];
        $menu = MenuItem::find($request->id);
        $menu->$entity = $id;
        $menu->save();

        $menu->title = $request->title;
        if (!$request->locale_id || ($request->locale_id === DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            $menu->save();
        } else if ($request->locale_id && ($request->locale_id !== DefaultData::where('title', 'locale')->get()->pluck('value')->first())) {
            LocaleContent::createTranslatedProperty($menu, ['title'], $request->locale_id);
        }

        return response()->json(['status' => 1], 200);
    }

    public function delete(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:menu_items,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        return response()->json(['status' => $this->removeMenuItems($request->id)], 200);
    }

    private function removeMenuItems($id)
    {
        if (!MenuItem::where('parent_menu', $id)->get()->count()) {
            return MenuItem::where('id', $id)->delete();
        } else {
            MenuItem::where('parent_menu', $id)->get()->each(function ($menu_item) {
                $this->removeMenuItems($menu_item->id);
            });
            return MenuItem::where('id', $id)->delete();
        }
    }

    public function updateMenuItemOrder(Request $request)
    {
        $v = Validator::make($request->all(), [
            'order.*.id' => 'required|exists:menu_items,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        foreach ($request->order as $order) {
            MenuItem::where('id', $order['id'])->update([
                'order' => $order['order'],
            ]);
        }

        return response()->json(['status' => 1], 200);
    }
}
