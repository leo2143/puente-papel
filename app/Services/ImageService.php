<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ImageService
{
    /**
     * Tipos de imagen permitidos
     */
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
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

        // Validar archivo
        self::validateFile($file);

        // Generar nombre único
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
     * Obtener la ruta relativa de una imagen
     *
     * @param string $fileName
     * @param string $type
     * @return string|null
     */
    public static function getPath(string $fileName, string $type): ?string
    {
        if (!$fileName || !array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return null;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        return "{$directory}/{$fileName}";
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
     * Obtener información de una imagen
     *
     * @param string $fileName
     * @param string $type
     * @return array|null
     */
    public static function getInfo(string $fileName, string $type): ?array
    {
        if (!self::exists($fileName, $type)) {
            return null;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = "{$directory}/{$fileName}";
        $absolutePath = Storage::disk('public')->path($fullPath);

        $info = getimagesize($absolutePath);

        if (!$info) {
            return null;
        }

        return [
            'width' => $info[0],
            'height' => $info[1],
            'type' => $info[2],
            'mime' => $info['mime'],
            'size' => filesize($absolutePath),
            'extension' => pathinfo($fileName, PATHINFO_EXTENSION)
        ];
    }

    /**
     * Redimensionar una imagen
     *
     * @param string $fileName
     * @param string $type
     * @param int $width
     * @param int $height
     * @param bool $maintainAspectRatio
     * @return string|null Nuevo nombre del archivo
     */
    public static function resize(string $fileName, string $type, int $width, int $height, bool $maintainAspectRatio = true): ?string
    {
        if (!self::exists($fileName, $type)) {
            return null;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = "{$directory}/{$fileName}";
        $absolutePath = Storage::disk('public')->path($fullPath);

        // Crear imagen desde archivo
        $imageInfo = getimagesize($absolutePath);
        if (!$imageInfo) {
            return null;
        }

        /** @var \GdImage $sourceImage */
        $sourceImage = self::createImageFromFile($absolutePath, $imageInfo[2]);
        if (!$sourceImage) {
            return null;
        }

        // Calcular nuevas dimensiones
        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);

        if ($maintainAspectRatio) {
            $ratio = min($width / $originalWidth, $height / $originalHeight);
            $newWidth = intval($originalWidth * $ratio);
            $newHeight = intval($originalHeight * $ratio);
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }

        // Crear nueva imagen
        /** @var \GdImage $resizedImage */
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preservar transparencia para PNG
        if ($imageInfo[2] == IMAGETYPE_PNG) {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
            imagefill($resizedImage, 0, 0, $transparent);
        }

        // Redimensionar
        imagecopyresampled(
            $resizedImage, $sourceImage,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );

        // Generar nuevo nombre
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = self::generateUniqueFileName($extension);

        // Guardar imagen redimensionada
        $newPath = Storage::disk('public')->path("{$directory}/{$newFileName}");
        $saved = self::saveImageToFile($resizedImage, $newPath, $imageInfo[2]);

        // Limpiar memoria
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        return $saved ? $newFileName : null;
    }

    /**
     * Limpiar imágenes huérfanas (no referenciadas en BD)
     *
     * @param string $type
     * @param array $usedImages Array de nombres de imágenes en uso
     * @return int Número de imágenes eliminadas
     */
    public static function cleanupOrphaned(string $type, array $usedImages): int
    {
        if (!array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return 0;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $files = Storage::disk('public')->files($directory);
        $deleted = 0;

        foreach ($files as $file) {
            $fileName = basename($file);
            if (!in_array($fileName, $usedImages)) {
                if (Storage::disk('public')->delete($file)) {
                    $deleted++;
                }
            }
        }

        return $deleted;
    }

    /**
     * Crear directorio si no existe
     *
     * @param string $type
     * @return bool
     */
    public static function ensureDirectoryExists(string $type): bool
    {
        if (!array_key_exists($type, self::IMAGE_DIRECTORIES)) {
            return false;
        }

        $directory = self::IMAGE_DIRECTORIES[$type];
        $fullPath = public_path('storage/' . $directory);

        if (!is_dir($fullPath)) {
            return mkdir($fullPath, 0755, true);
        }

        return true;
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

        // Verificar tamaño
        $sizeMB = $file->getSize() / (1024 * 1024);
        if ($sizeMB > self::MAX_SIZE_MB) {
            throw new Exception("El archivo es demasiado grande. Tamaño máximo: " . self::MAX_SIZE_MB . "MB");
        }

        // Verificar que es realmente una imagen
        $mimeType = $file->getMimeType();
        if (!str_starts_with($mimeType, 'image/')) {
            throw new Exception("El archivo no es una imagen válida");
        }
    }

    /**
     * Generar nombre único para archivo usando fecha epoch
     *
     * @param UploadedFile|string $file
     * @return string
     */
    private static function generateUniqueFileName($file): string
    {
        if ($file instanceof UploadedFile) {
            $extension = strtolower($file->getClientOriginalExtension());
        } else {
            $extension = $file;
        }

        // Usar solo la fecha actual en epoch
        $timestamp = time();
        
        return "{$timestamp}.{$extension}";
    }

    /**
     * Crear imagen desde archivo
     *
     * @param string $path
     * @param int $imageType
     * @return \GdImage|false
     */
    private static function createImageFromFile(string $path, int $imageType)
    {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($path);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($path);
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($path);
            default:
                return false;
        }
    }

    /**
     * Guardar imagen a archivo
     *
     * @param \GdImage $image
     * @param string $path
     * @param int $imageType
     * @return bool
     */
    private static function saveImageToFile($image, string $path, int $imageType): bool
    {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                return imagejpeg($image, $path, 90);
            case IMAGETYPE_PNG:
                return imagepng($image, $path, 9);
            case IMAGETYPE_GIF:
                return imagegif($image, $path);
            case IMAGETYPE_WEBP:
                return imagewebp($image, $path, 90);
            default:
                return false;
        }
    }
}
