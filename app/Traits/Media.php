<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Exception;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Log;

trait Media
{
    public static function saveImage($image, string $folder, int $width = 1024, int $height = 700): string|false
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

            return $filePath;
        } catch (Exception $e) {
            Log::error('Image save failed');
            return false;
        }
    }
}
