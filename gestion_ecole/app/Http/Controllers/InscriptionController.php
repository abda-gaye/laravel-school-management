<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    public function store(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'date_inscription' => 'required|date_format:Y-m-d',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                return Inscription::create([
                    'date_inscription' => $request->date_inscription,
                ]);
            }
        }

    }
}
