<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Models\Caracteristica;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('categorias.index');
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
    public function store(StoreCategoriaRequest $request)
    {
        Log::info('StoreCategoriaRequest', [
            'request' => $request->all()
        ]);
        //
        try{
            DB::beginTransaction();

            // Crear la característica
            $caracteristica = Caracteristica::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'destacado' => $request->input('destacado', 0), // Por defecto, será 0 si no está marcado
            ]);

            // Crear la categoría asociada
            $categoria = $caracteristica->categorias()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();

            // Retornar respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Categoría registrada con éxito.',
                'data' => $categoria // Incluye la información de la categoría
            ]);

        } catch (Exception $e){
            DB::rollBack();
            // Retornar error en JSON
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la categoría.',
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
