<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Models\Caracteristica;
use App\Models\Marca;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marcas = Marca::with('caracteristica')->latest()->get();
        return view('marcas.index', ['marcas' => $marcas]);
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
    public function store(StoreMarcaRequest $request)
    {
        //
        try{
            DB::beginTransaction();

            // Crear la característica
            $caracteristica = Caracteristica::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'destacado' => $request->input('destacado', 0), // Por defecto, será 0 si no está marcado
            ]);

            // Crear la marca asociada
            $marca = $caracteristica->marcas()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();

            // Retornar respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Marca registrada con éxito.',
                'data' => $marca // Incluye la información de la marca
            ]);

        } catch (Exception $e){
            DB::rollBack();
            // Retornar error en JSON
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la marca.',
                'error' => $e->getMessage() // Opcional
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
