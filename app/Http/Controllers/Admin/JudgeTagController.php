<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JudgeTag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JudgeTagController extends Controller
{
    public function index()
    {
        $title = "Judge Tags";
        $tags = JudgeTag::withCount('judges')->orderBy('name')->get();
        return view('admin.judge-tags.index', compact('tags', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('judge_tags', 'name')
            ]
        ]);

        $tag = JudgeTag::create(['name' => $request->name]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'tag' => $tag
            ]);
        }

        toast_created('Tag');
        return redirect()->route('admin.judge-tags.index');
    }

    public function update(Request $request, JudgeTag $judgeTag)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('judge_tags', 'name')->ignore($judgeTag->id)
            ]
        ]);

        $judgeTag->update(['name' => $request->name]);
        toast_updated('Tag');
        return redirect()->route('admin.judge-tags.index');
    }

    public function destroy(JudgeTag $judgeTag)
    {
        try {
            $judgeTag->delete();
            toast_deleted('Tag');
        } catch (\Throwable $e) {
            toast_error('Unable to delete tag. It may be in use.');
        }
        return back();
    }
}
