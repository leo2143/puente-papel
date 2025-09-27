<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Redireccionar con mensaje de éxito
     */
    protected function redirectWithSuccess($route, $message)
    {
        return redirect()->route($route)->with('success', $message);
    }

    /**
     * Redireccionar con mensaje de error
     */
    protected function redirectWithError($route, $message)
    {
        return redirect()->route($route)->with('error', $message);
    }

    /**
     * Respuesta JSON exitosa
     */
    protected function jsonSuccess($data = null, $message = 'Operación exitosa', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Respuesta JSON de error
     */
    protected function jsonError($message = 'Error en la operación', $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }

    /**
     * Obtener usuario actual
     */
    protected function currentUser()
    {
        return auth()->user();
    }

    /**
     * Verificar si el usuario está autenticado
     */
    protected function requireAuth()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    }
}
