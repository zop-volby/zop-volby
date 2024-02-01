<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function edit()
    {
        $model = Election::find(1);
        return view('election.edit', compact('model'));
    }

    public function update(Request $request)
    {
        $model = Election::find(1);
        $model->name = $request->input('name');
        $model->start_at = $request->input('start_at');
        $model->phase = $request->input('phase');
        $model->save();
        return view(RouteServiceProvider::HOME);
    }
}