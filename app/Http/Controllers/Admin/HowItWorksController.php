<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWorksStep;

class HowItWorksController extends Controller
{
    public function index()
    {
        $steps = HowItWorksStep::orderBy('step_number')->get();
        return view('admin.how-it-works.index', compact('steps'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        HowItWorksStep::create($data);
        toast_created('Step');
        return back();
    }

    public function update(Request $request, HowItWorksStep $step)
    {
        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $step->update($data);
        toast_updated('Step');
        return back();
    }

    public function destroy(HowItWorksStep $step)
    {
        $step->delete();
        toast_deleted('Step');
        return back();
    }
}
