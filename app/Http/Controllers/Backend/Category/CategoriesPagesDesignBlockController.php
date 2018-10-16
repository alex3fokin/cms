<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category\CategoriesPagesBlocksContent;
use App\Models\Backend\Category\CategoriesPagesDesignBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesPagesDesignBlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addChildDesignBlock(Request $request) {
        $v = Validator::make($request->all(), [
            'parent_design_block' => 'required|exists:categories_pages_design_blocks,id',
            'design_block' => 'nullable|exists:design_blocks,title',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        CategoriesPagesDesignBlock::addDesignBlocks(
            CategoriesPagesDesignBlock::where('id', $request->parent_design_block)->get()->pluck('categories_pages_id')->first(),
            $request->parent_design_block,
            [$request->design_block]);

        return response()->json(['status' => 1], 200);
    }

    public function deleteDesignBlock(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:categories_pages_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        CategoriesPagesDesignBlock::where('id', $request->id)->delete();

        return response()->json(['status' => 1], 200);
    }

    public function updateDesignBlocksOrder(Request $request)
    {
        $v = Validator::make($request->all(), [
            'order.*.id' => 'required|exists:categories_pages_design_blocks,id',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }
        foreach ($request->order as $order) {
            CategoriesPagesDesignBlock::where('id', $order['id'])->update([
                'order' => $order['order'],
            ]);
        }

        return response()->json(['status' => 1], 200);
    }
}
