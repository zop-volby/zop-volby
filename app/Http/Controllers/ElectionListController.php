<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $model = new ElectionList();
        return view('lists.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $model = ElectionList::findOrFail($id);
        return view('lists.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        //
    }
}
