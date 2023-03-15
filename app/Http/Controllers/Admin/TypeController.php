<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:types'
        ], [
            'name.required' => 'Devi inserire un nome.',
            'name.string' => 'Devi inserire un nome valido.',
            'name.unique' => 'La tipologia inserita è già presente.'
        ]);
        $type = new Type();
        $type->name = $request->input('name');
        $type->save();

        return to_route('admin.types.index')->with('type', 'success')->with('msg', "$type->name aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'edit-name' => ['required', 'string', Rule::unique('types', 'name')->ignore($type->id)]
        ], [
            'edit-name.required' => 'Devi inserire un nome valido.',
            'edit-name.unique' => 'La tipologia inserita è già presente.'
        ]);
        $type->name = $request->input('edit-name');
        $type->save();

        return to_route('admin.types.index')->with('type', 'success')->with('msg', "$type->name modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('type', 'danger')->with('msg', "$type->name eliminato correttamente");
    }
}
