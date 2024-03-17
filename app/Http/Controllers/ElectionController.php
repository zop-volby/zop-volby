<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function edit()
    {
        $model = Election::find(1);
        return Gate::allows('admin') ? view('election.edit', compact('model')) : view('election.view', compact('model'));
    }

    public function update(Request $request)
    {
        if (!Gate::allows('admin')) {
            return abort(403, 'Only administrators can edit the election.');
        }

        $request->validate([
            'name' => 'required',
            'start_at' => 'required|date',
            'phase' => 'required',
        ]);
        $model = Election::find(1);
        $model->name = $request->input('name');
        $model->start_at = $request->input('start_at');
        $model->phase = $request->input('phase');
        $model->save();
        return redirect()->route('dashboard');
    }
}