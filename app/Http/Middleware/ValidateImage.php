<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateImage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo validar si hay archivos de imagen en la request
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Validar que el archivo existe y es válido
            if (!$file->isValid()) {
                return back()->withErrors(['image' => 'El archivo de imagen no es válido.'])->withInput();
            }

            // Validar extensión
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());
            
            if (!in_array($extension, $allowedExtensions)) {
                return back()->withErrors(['image' => 'Tipo de archivo no permitido. Tipos válidos: ' . implode(', ', $allowedExtensions)])->withInput();
            }

            // Validar tamaño (5MB máximo)
            $maxSize = 5 * 1024 * 1024; // 5MB en bytes
            if ($file->getSize() > $maxSize) {
                return back()->withErrors(['image' => 'El archivo es demasiado grande. Tamaño máximo: 5MB'])->withInput();
            }

            // Validar MIME type
            $mimeType = $file->getMimeType();
            if (!str_starts_with($mimeType, 'image/')) {
                return back()->withErrors(['image' => 'El archivo no es una imagen válida.'])->withInput();
            }
        }

        return $next($request);
    }
}
