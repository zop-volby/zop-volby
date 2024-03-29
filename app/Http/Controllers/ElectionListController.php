<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ElectionList;

class ElectionListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = ElectionList::all();
        return view('lists.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('preparation');
        $model = new ElectionList();
        return view('lists.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('preparation');
        $model = new ElectionList();
        $model->fill($request->all());
        $model->save();
        return redirect()->route('lists.index');
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
        $model = ElectionList::findOrFail($id);
        return view('lists.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('preparation');
        $model = ElectionList::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return redirect()->route('lists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('preparation');
        $model = ElectionList::findOrFail($id);
        $model->nominees()->detach();
        $model->delete();
        return redirect()->route('lists.index');
    }

    public function get_nominees(string $id)
    {
        $model = ElectionList::findOrFail($id);
        return view('lists.nominees', compact('model'));
    }

    public function put_nominees(Request $request, string $id)
    {
        $model = ElectionList::findOrFail($id);
        $model->nominees()->sync($request->nominees);
        return redirect()->route('lists.index');
    }
}
