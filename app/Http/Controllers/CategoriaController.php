<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCaracteristicaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
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
        $categorias = Categoria::with('caracteristica')->latest()->get();
        return view('categorias.index', ['categorias' => $categorias]);
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
        // Log::info('StoreCategoriaRequest', [
        //     'request' => $request->all()
        // ]);
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
    public function show(Categoria $categoria)
    {
        // Cargar la categoría con la relación de características
        $categoria->load('caracteristica');

        return response()->json([
            'success' => true,
            'data' => $categoria,
        ]);
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
    public function update(UpdateCaracteristicaRequest $request, $id)
    {
        //
        try{
            DB::beginTransaction();

            $categoria = Categoria::findOrFail($id);

            $caracteristica = $categoria->caracteristica;

             $caracteristica->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'destacado' => $request->input('destacado'), // Por defecto, será 0 si no está marcado
            ]);

            DB::commit();

             return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada con éxito.',
                'data' => $caracteristica,
            ], 200);

        }catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoría: ' . $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada.',
            ], 404);
        }

        try {
            if ($categoria->caracteristica->estado == 1) {
                Caracteristica::where('id', $categoria->caracteristica->id)
                    ->update(['estado' => 0]);

                return response()->json([
                    'success' => true,
                    'message' => 'Categoría eliminada correctamente.',
                    'action' => 'eliminar',
                ], 200);
            } else {
                Caracteristica::where('id', $categoria->caracteristica->id)
                    ->update(['estado' => 1]);

                return response()->json([
                    'success' => true,
                    'message' => 'Categoría restaurada correctamente.',
                    'action' => 'restaurar',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoría: ' . $e->getMessage(),
            ], 500);
        }
    }
}
