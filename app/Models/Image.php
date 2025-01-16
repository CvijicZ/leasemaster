<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Exception;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class Image extends Model
{

    public static function saveImage($image, string $folder, int $width = 800, int $height = 600): string|false
    {
        try {
            if (!($image instanceof \Illuminate\Http\UploadedFile)) {
                throw new \InvalidArgumentException('Expected an UploadedFile instance.');
            }
    
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
    
            $fileName = uniqid() . '.webp';
            $filePath = "{$folder}/{$fileName}";
    
            $image = InterventionImage::make($image)
                ->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 85);
    
            Storage::disk('public')->put($filePath, $image->stream()->getContents());
    
            return Storage::disk('public')->url($filePath);
        } catch (Exception $e) {
            Log::error('Image save failed');
            return false;
        }
    }
    


    public static function getImage(string $path)
    {

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Image not found.');
        }

        return Storage::disk('public')->get($path);
    }
}
