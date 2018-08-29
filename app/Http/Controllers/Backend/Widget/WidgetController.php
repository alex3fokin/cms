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

        $this->addDesignBlocks($widget->id, null, $request->design_blocks);

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
        $this->addDesignBlocks(
            WidgetsDesignBlock::where('id', $request->parent_design_block)->get()->pluck('widget_id')->first(),
            $request->parent_design_block,
            [$request->design_block]);

        return response()->json(['status' => 1], 200);
    }

    private function addDesignBlocks($id, $parent_id, $design_blocks)
    {
        $i = WidgetsDesignBlock::where('parent_design_block', $parent_id)->max('order') ?? 0;
        $i++;
        foreach ($design_blocks as $design_block) {
            $design_block = DesignBlock::where('title', $design_block)->get()->first();
            $widget_design_block = WidgetsDesignBlock::create([
                'order' => $i,
                'widget_id' => $id,
                'design_block_id' => $design_block->id,
                'parent_design_block' => $parent_id,
            ]);
            foreach ($design_block->info_blocks as $info_block) {
                $widget_design_block_content = WidgetsBlocksContent::create([
                    'design_blocks_info_block_id' => $info_block->id,
                    'widgets_design_block_id' => $widget_design_block->id,
                ]);
                Locale::all()->each(function ($locale) use ($widget_design_block_content) {
                    WidgetsBlocksLocaleContent::create([
                        'widgets_blocks_content_id' => $widget_design_block_content->id,
                        'locale_id' => $locale->id,
                        'value' => '',
                    ]);
                });
            }
            $i++;
            if ($children_design_blocks = $design_block->children) {
                $this->addDesignBlocks($id, $widget_design_block->id, $children_design_blocks->pluck('title'));
            }
        }
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
            $this->removeDesignBlocks($widget_design_block->id);

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

        $this->removeDesignBlocks($request->id);

        return response()->json(['status' => 1], 200);
    }

    private function removeDesignBlocks($id)
    {
        if (!WidgetsDesignBlock::where('parent_design_block', $id)->get()->count()) {
            WidgetsBlocksContent::where('widgets_design_block_id', $id)->get()->each(function($widgets_blocks_content) {
                WidgetsBlocksLocaleContent::where('widgets_blocks_content_id', $widgets_blocks_content->id)->delete();
            });
            WidgetsBlocksContent::where('widgets_design_block_id', $id)->delete();
            return WidgetsDesignBlock::where('id', $id)->delete();
        } else {
            WidgetsDesignBlock::where('parent_design_block', $id)->get()->each(function ($widget_design_block) {
                $this->removeDesignBlocks($widget_design_block->id);
            });
            WidgetsBlocksContent::where('widgets_design_block_id', $id)->get()->each(function($widgets_blocks_content) {
                WidgetsBlocksLocaleContent::where('widgets_blocks_content_id', $widgets_blocks_content->id)->delete();
            });
            WidgetsBlocksContent::where('widgets_design_block_id', $id)->delete();
            return WidgetsDesignBlock::where('id', $id)->delete();
        }
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
