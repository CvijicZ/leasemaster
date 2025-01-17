<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Model;
use Exception;

class VehicleImage extends Model
{
    use Media;

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
            }
        } catch (Exception $e) {
            dd('Failed to save vehicle image', $e->getMessage(), $e->getTraceAsString());
        }

        return false;
    }
}
