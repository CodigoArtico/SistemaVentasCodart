<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentacionRequest;
use App\Http\Requests\UpdatePresentacionRequest;
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
    public function show(Presentacion $presentacione)
    {
        // Cargar la relación de caracteristica
        $presentacione->load('caracteristica');

        return response()->json([
            'success' => true,
            'data' => $presentacione,
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
    public function update(UpdatePresentacionRequest $request, $id)
    {
        //
        try {
            DB::beginTransaction();

            $presentacion = Presentacion::findOrFail($id);

            $caracteristica = $presentacion->caracteristica;

            $caracteristica->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'destacado' => $request->input('destacado'), // Por defecto, será 0 si no está marcado
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Presentacion actualizada con éxito.',
                'data' => $caracteristica,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la presentacion: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presentacion = Presentacion::find($id);

        if (!$presentacion) {
            return response()->json([
                'success' => false,
                'message' => 'Presentacion no encontrada.',
            ], 404);
        }

        if ($presentacion->caracteristica->estado == 1) {
            Caracteristica::where('id', $presentacion->caracteristica->id)
                ->update(['estado' => 0]);

            return response()->json([
                'success' => true,
                'message' => 'Presentacion eliminada correctamente.',
                'action' => 'eliminar',
            ]);
        } else {
            Caracteristica::where('id', $presentacion->caracteristica->id)
                ->update(['estado' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Presentacion restaurada correctamente.',
                'action' => 'restaurar',
            ]);
        }
    }
}
