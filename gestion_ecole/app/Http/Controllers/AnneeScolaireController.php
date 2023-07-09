<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AnneeScolaire::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'libelle' => "required|unique:annee_scolaires"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        return AnneeScolaire::created([
            "libelle" => $request->libelle
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnneeScolaire $anneeScolaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnneeScolaire $anneeScolaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeScolaire $anneeScolaire)
    {
        //
    }
}
