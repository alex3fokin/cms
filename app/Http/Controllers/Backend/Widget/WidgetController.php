<?php

namespace App\Http\Controllers\Backend\Widget;

use App\Http\Controllers\Controller;
use App\Models\Backend\DesignBlock;
use App\Models\Backend\Locale;
use App\Models\Backend\Widget\Widget;
use App\Models\Backend\Widget\WidgetsBlocksContent;
use App\Models\Backend\Widget\WidgetsBlocksLocaleContent;
use App\Models\Backend\Widget\WidgetsDesignBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WidgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:widgets',
            'design_blocks.*' => 'nullable|exists:design_blocks,title',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        $widget = Widget::create([
            'title' => $request->title,
        ]);

        WidgetsDesignBlock::addDesignBlocks($widget->id, null, $request->design_blocks);

        return response()->json(['widget' => $widget], 200);
    }

    public function addDesignBlock(Request $request)
    {
        $v = Validator::make($request->all(), [
            'parent_design_block' => 'required|exists:widgets_design_blocks,id',
            'design_block' => 'nullable|exists:design_blocks,title',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        WidgetsDesignBlock::addDesignBlocks(
            WidgetsDesignBlock::where('id', $request->parent_design_block)->get()->pluck('widget_id')->first(),
            $request->parent_design_block,
            [$request->design_block]);

        return response()->json(['status' => 1], 200);
    }

    public function update(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:widgets,id',
            'title' => ['required', Rule::unique('widgets')->ignore($request->id)],
        ]);

        if ($v->fails()) {
            $old_widget = Widget::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_widget], 400);
        }

        return response()->json(['status' => Widget::where('id', $request->id)->update([
            'title' => $request->title,
        ])], 200);
    }

    public function delete(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:widgets,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        WidgetsDesignBlock::where([['widget_id', $request->id], ['parent_design_block', null]])->get()->each(function ($widget_design_block) {
            WidgetsDesignBlock::removeDesignBlocks($widget_design_block->id);

        });
        Widget::where('id', $request->id)->delete();
        return response()->json(['status' => 1], 200);
    }

    public function deleteDesignBlock(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:widgets_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        WidgetsDesignBlock::removeDesignBlocks($request->id);

        return response()->json(['status' => 1], 200);
    }

    public function updateDesignBlocksOrder(Request $request)
    {
        $v = Validator::make($request->all(), [
            'order.*.id' => 'required|exists:widgets_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        foreach ($request->order as $order) {
            WidgetsDesignBlock::where('id', $order['id'])->update([
                'order' => $order['order'],
            ]);
        }

        return response()->json(['status' => 1], 200);
    }
}
