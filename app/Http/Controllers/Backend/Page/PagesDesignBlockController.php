<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Backend\DesignBlock;
use App\Models\Backend\Locale;
use App\Models\Backend\Page\PagesBlocksContent;
use App\Models\Backend\Page\PagesBlocksLocaleContent;
use App\Models\Backend\Page\PagesDesignBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesDesignBlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addDesignBlock(Request $request) {
        $v = Validator::make($request->all(), [
            'page_id' => 'required|exists:pages,id',
            'design_block_id' => 'required|exists:design_blocks,id'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        PagesDesignBlock::addDesignBlocks($request->page_id, null, DesignBlock::where('id', $request->design_block_id)->get()->pluck('title'));

        return response()->json(['status' => 1],200);
    }

    public function addChildDesignBlock(Request $request) {
        $v = Validator::make($request->all(), [
            'parent_design_block' => 'required|exists:pages_design_blocks,id',
            'design_block' => 'nullable|exists:design_blocks,title',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        PagesDesignBlock::addDesignBlocks(
            PagesDesignBlock::where('id', $request->parent_design_block)->get()->pluck('page_id')->first(),
            $request->parent_design_block,
            [$request->design_block]);

        return response()->json(['status' => 1], 200);
    }

    public function addWidget(Request $request) {
        $v = Validator::make($request->all(), [
            'page_id' => 'required|exists:pages,id',
            'widget_id' => 'required|exists:widgets,id'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }
        $i = PagesDesignBlock::where('parent_design_block', null)->max('order') ?? 0;
        return response()->json(['page_design_block' => PagesDesignBlock::create([
            'order' => ++$i,
            'page_id' => $request->page_id,
            'widget_id' => $request->widget_id,
        ])],200);
    }

    public function deleteDesignBlock(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:pages_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        PagesDesignBlock::where('id', $request->id)->delete();

        return response()->json(['status' => 1], 200);
    }

    public function updateDesignBlocksOrder(Request $request)
    {
        $v = Validator::make($request->all(), [
            'order.*.id' => 'required|exists:pages_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        foreach ($request->order as $order) {
            PagesDesignBlock::where('id', $order['id'])->update([
                'order' => $order['order'],
            ]);
        }

        return response()->json(['status' => 1], 200);
    }
}
