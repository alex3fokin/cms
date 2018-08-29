<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Menu;
use App\Models\Backend\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:menus,title'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        return response()->json(['menu' => Menu::create([
            'title' => $request->title,
        ])],200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:menus,id'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        MenuItem::where([['menu_id', $request->id], ['parent_menu', null]])->get()->each(function ($menu_item) {
            $this->removeMenuItems($menu_item->id);
        });

        return response()->json(['status' => Menu::where('id', $request->id)->delete()],200);
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
}
