<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class VehicleImage extends Image
{
    protected $table = "vehicle_images";
    const IMAGE_FOLDER = 'vehicles';

    protected $fillable = [
        'path',
        'vehicle_id'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public static function saveVehicleImage($image, $vehicleId): bool
    {
        try {

            $imagePath = self::saveImage($image, self::IMAGE_FOLDER);

            if ($imagePath) {

                self::create([
                    'path'       => $imagePath,
                    'vehicle_id' => $vehicleId,
                ]);

                return true;
            }
        } catch (Exception $e) {
            dd('Failed to save vehicle image', $e->getMessage(), $e->getTraceAsString());
        }

        return false;
    }
}
