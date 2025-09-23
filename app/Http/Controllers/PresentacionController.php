<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentacionRequest;
use App\Models\Caracteristica;
use App\Models\Presentacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacion::with('caracteristica')->latest()->get();
        return view('presentaciones.index', ['presentaciones' => $presentaciones]);
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
    public function store(StorePresentacionRequest $request)
    {
        try {
            DB::beginTransaction();

            // Crear la característica
            $caracteristica = Caracteristica::create($request->validated());

            // Crear la presentación asociada
            $caracteristica->presentaciones()->create([
                'caracteristica_id' => $caracteristica->id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Presentación registrada con éxito.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la presentación: ' . $e->getMessage(),
            ], 500);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
