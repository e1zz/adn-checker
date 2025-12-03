<?php

namespace App\Http\Controllers;

use App\Models\DnaVerification;
use App\Services\MutationService;
use Illuminate\Http\Request;

class MutationController extends Controller
{
    public function check(Request $request)
    {
        $dna = $request->input('dna');

        // Validar que dna no sea null o vacío
        if (!$dna || !is_array($dna)) {
            return response()->json([
                'error' => false,
                'message' => 'Invalid request: dna parameter is required and must be an array'
            ], 400);
        }

        // Verifica mutación
        $result = MutationService::hasMutation($dna);

        // Guarda o recupera en DB
        $dnaEncoded = json_encode($dna);
        DnaVerification::firstOrCreate(
            ['dna' => $dnaEncoded],
            ['mutation' => $result['ok']]
        );

        // Retorna según mutación
        if ($result['ok'] === true) {
            return response()->json($result, 200);
        }

        return response()->json($result, 403);
    }
}
