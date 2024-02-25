<?php

namespace App\Http\Controllers;

use App\Models\Nominee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class NomineeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Nominee::all();
        return view('nominees.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('preparation');
        $model = new Nominee();
        return view('nominees.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('preparation');
        $model = new Nominee();
        $model->fill($request->all());
        $model->save();

        $newLists = $request->input('electionLists');
        $model->electionLists()->sync($newLists);

        return redirect()->route('nominees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('preparation');
        $model = Nominee::findOrFail($id);
        return view('nominees.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('preparation');
        $model = Nominee::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        $newLists = $request->input('electionLists');
        $model->electionLists()->sync($newLists);

        return redirect()->route('nominees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('preparation');
        $model = Nominee::findOrFail($id);
        $model->electionLists()->detach();
        $model->delete();
        return redirect()->route('nominees.index');
    }
}
