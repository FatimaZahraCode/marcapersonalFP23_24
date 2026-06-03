<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermisoDescargaResource;
use App\Models\PermisoDescarga;
use Illuminate\Http\Request;

class PermisoDescargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(PermisoDescarga::class, 'idioma');
    }

    public $modelclass = PermisoDescarga::class;

    public function index(Request $request)
    {
        $query = PermisoDescarga::query();
            if ($query) {
                $query->orWhere('curriculo_id', 'like', '%' . $request->q . '%');
            }

            return PermisoDescargaResource::collection(
            PermisoDescarga::orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
            ->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permisoDescarga = json_decode($request->getContent(), true);

        $permisoDescarga = PermisoDescarga::create($permisoDescarga);

        return new PermisoDescargaResource($permisoDescarga);
    }

    /**
     * Display the specified resource.
     */
    public function show(PermisoDescarga $permisoDescarga)
    {
        return new PermisoDescargaResource($permisoDescarga);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PermisoDescarga $permisoDescarga)
    {
        $permisoData = json_decode($request->getContent(), true);
        $permisoDescarga->update($permisoData);

        return new PermisoDescargaResource($permisoDescarga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermisoDescarga $permisoDescarga)
    {
         try {
            $permisoDescarga->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
