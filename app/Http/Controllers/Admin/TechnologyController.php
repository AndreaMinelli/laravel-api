<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:technologies',
            'logo' => 'nullable|image',

        ], [
            'name.required' => 'Devi inserire un nome valido!',
            'name.unique' => 'La tecnologia inserita è già presente.',
            'logo.image' => 'Il file caricato deve essere un\'immagine.',

        ]);
        $data = $request->all();
        $technology = new Technology();
        if (Arr::exists($data, 'logo')) {
            $data['logo'] = Storage::put('technologies', $data['logo']);
        }
        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.index')->with('msg', "La technologia $technology->name è stata aggiunta correttamente.")->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return to_route('admin.technologies.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('technologies')->ignore($technology->id)],
            'logo' => 'nullable|image',

        ], [
            'name.required' => 'Devi inserire un nome valido!',
            'name.unique' => 'La tecnologia inserita è già presente.',
            'logo.image' => 'Il file caricato deve essere un\'immagine.',

        ]);

        $data = $request->all();
        if (Arr::exists($data, 'logo')) {
            if ($technology->logo) Storage::delete($technology->logo);
            $data['logo'] = Storage::put('technologies', $data['logo']);
        }
        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.index')->with('msg', "La tecnologia $technology->name è stata modificata.")->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        if ($technology->logo) Storage::delete($technology->logo);
        $technology->delete();
        return to_route('admin.technologies.index')->with('msg', "La tecnologia $technology->name è stata eliminata.")->with('type', 'danger');
    }
}
