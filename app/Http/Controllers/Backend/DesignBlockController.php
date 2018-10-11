<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DesignBlocksInfoBlock;
use App\Models\Backend\DesignBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DesignBlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //Add, update, delete design blocks

    public function add(Request $request) {
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:design_blocks',
            'view' => 'sometimes',
            'design_blocks.*' => ['nullable', Rule::in(DesignBlock::all()->pluck('title'))],
            'css_classes' => 'nullable',
            'info_blocks.*.id' => 'required|exists:info_blocks,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        $design_block = DesignBlock::create([
            'title' => $request->title,
            'view' => $request->view,
            'design_blocks' => implode(',', $request->design_blocks),
            'css_classes' => $request->css_classes,
        ]);
        if($request->info_blocks) {
            foreach($request->info_blocks as $info_block) {
                DesignBlocksInfoBlock::create([
                    'info_block_id' => $info_block['id'],
                    'design_block_id' => $design_block->id,
                    'title' => $info_block['title'],
                ]);
            }
        }

        return response()->json(['design_block' => $design_block] ,200);
    }

    public function update(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:design_blocks,id',
            'title' => ['required', Rule::unique('design_blocks')->ignore($request->id)],
            'view' => 'sometimes',
            'design_blocks.*' => ['nullable', Rule::in(DesignBlock::all()->pluck('title'))],
            'css_classes' => 'nullable',
        ]);

        if($v->fails()) {
            $old_design_block = DesignBlock::find($request->id);
            return response()->json(['errors' => $v->errors(), 'old_data' => $old_design_block], 400);
        }
        $result = DesignBlock::where('id', $request->id)->update([
            'title' => $request->title,
            'view' => $request->view,
            'design_blocks' => $request->design_blocks ? implode(',', $request->design_blocks) : '',
            'css_classes' => $request->css_classes,
        ]);
        $design_blocks = DesignBlock::all()->pluck('title');

        return response()->json(['status' => $result, 'design_blocks' => $design_blocks],200);
    }

    public function delete(Request $request) {
        $v = Validator::make($request->all(), [
            'id' => 'required|exists:design_blocks,id',
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        DesignBlocksInfoBlock::where('design_block_id', $request->id)->delete();

        return response()->json(['status' => DesignBlock::where('id', $request->id)->delete()], 200);
    }
}
