<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class ImageService
{
    /**
     * Tipos de imagen permitidos
     */
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];
    
    /**
     * Tamaño máximo en MB
     */
    const MAX_SIZE_MB = 5;
    
    /**
     * Directorios de imágenes por tipo
     */
    const IMAGE_DIRECTORIES = [
        'products' => 'images/products',
        'blog' => 'images/blog',
        'users' => 'images/users',
        'carousel' => 'images/carousel',
        'footer' => 'images/footer',
        'utils' => 'images/utils',
        'items' => 'images/products',
        'icons' => 'images/users'
    ];

    /**
     * Subir una imagen y retornar el nombre del archivo
     *
     * @param UploadedFile $file
     * @param string $type Tipo de imagen (products, blog, users, carousel, footer, utils)
     * @param string|null $oldImage Nombre de imagen anterior para eliminar
     * @return string Nombre del archivo guardado
     * @throws Exception
     */
    public static function upload(UploadedFile $file, string $type, ?string $oldImage = null): string
    {
        // Validar tipo de directorio
        if (!array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            throw new Exception("Tipo de imagen no válido: {$type}. Tipos válidos: " . implode(', ', array_keys(self::IMAGE_DIRECTORIES)));
        }

        self::validateFile($file);

        $fileName = self::generateUniqueFileName($file);

        // Directorio de destino
        $directory = self::IMAGE_DIRECTORIES[$type];

        // Eliminar imagen anterior si existe
        if ($oldImage) {
            self::delete($oldImage, $type);
        }

        // Guardar archivo
        $path = $file->storeAs($directory, $fileName, 'public');

        if (!$path) {
            throw new Exception("Error al guardar la imagen");
        }

        return $fileName;
    }

    /**
     * Eliminar una imagen
     *
     * @param string $fileName
     * @param string $type
     * @return bool
     */
    public static function delete(string $fileName, string $type): bool
    {
        if (!array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return false;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = "{$directory}/{$fileName}";

        if (Storage::disk('public')->exists($fullPath)) {
            return Storage::disk('public')->delete($fullPath);
        }

        return false;
    }

    /**
     * Obtener la URL completa de una imagen
     *
     * @param string $fileName
     * @param string $type
     * @return string|null
     */
    public static function getUrl(string $fileName, string $type): ?string
    {
        if (!$fileName || !array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return null;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = "{$directory}/{$fileName}";

        if (Storage::disk('public')->exists($fullPath)) {
            return asset('storage/' . $fullPath);
        }

        return null;
    }

    /**
     * Verificar si una imagen existe
     *
     * @param string $fileName
     * @param string $type
     * @return bool
     */
    public static function exists(string $fileName, string $type): bool
    {
        if (!$fileName || !array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return false;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = "{$directory}/{$fileName}";

        return Storage::disk('public')->exists($fullPath);
    }

    /**
     * Validar archivo de imagen
     *
     * @param UploadedFile $file
     * @throws Exception
     */
    private static function validateFile(UploadedFile $file): void
    {
        // Verificar que es un archivo válido
        if (!$file->isValid()) {
            throw new Exception("Archivo no válido");
        }

        // Verificar extensión
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw new Exception("Tipo de archivo no permitido. Tipos válidos: " . implode(', ', self::ALLOWED_EXTENSIONS));
        }

        $sizeMB = $file->getSize() / (1024 * 1024);
        if ($sizeMB > self::MAX_SIZE_MB) {
            throw new Exception("El archivo es demasiado grande. Tamaño máximo: " . self::MAX_SIZE_MB . "MB");
        }

        $mimeType = $file->getMimeType();
        if (!str_starts_with($mimeType, 'image/')) {
            throw new Exception("El archivo no es una imagen válida");
        }
    }

    /**
     * Generar nombre único para archivo usando fecha epoch
     *
     * @param UploadedFile $file
     * @return string
     */
    private static function generateUniqueFileName(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $timestamp = time();
        
        return "{$timestamp}.{$extension}";
    }
}
