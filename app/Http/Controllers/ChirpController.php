<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index',[
            //'chirps' => Chirp::orderBy('created_at','desc')->get()
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
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
        $validated = $request->validate([
            'message' => ['required','min:3']
        ]);
        
        $request->user()->chirps()->create($validated);

        //session->flash('status','Chirp created successfully');
        return to_route('chirps.index')
            ->with('status',__('Chirp created successfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //$chirp = Chirp::findOrFail($chirp) 
        //trae el objeto de la BD cuando solo se recibe el $chirp sin el Modelo CHIRP como parametro

        $this->authorize('update',$chirp);
        // if(auth()->user()->isNot($chirp->user)){
        //     abort(403);
        // }
        return view('chirps.edit', [
            'chirp'=> $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update',$chirp);
        // if(auth()->user()->isNot($chirp->user)){
        //     abort(403);
        // }
        $validated = $request->validate([
            'message' => ['required','min:3']
        ]);

        $chirp->update($validated);

        return to_route('chirps.index')
            ->with('status',__('Chirp updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete',$chirp);
        $chirp->delete($chirp);
        return to_route('chirps.index')
            ->with('status',__('Chirp deleted successfully!'));
    }
}
