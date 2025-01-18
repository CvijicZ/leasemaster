<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Media;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ProfilePicture extends Model
{
    use Media;

    const IMAGE_FOLDER = 'users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function saveProfilePicture(Request $request, $userId)
    {
        try {
            $imagePath = self::saveImage($request->profile_image, self::IMAGE_FOLDER);

            if ($imagePath) {
                self::updateOrCreate(
                    ['user_id' => $userId],
                    ['path' => $imagePath]
                );

                return back()->with(['success' => 'Profile picture updated']);
            }
        } catch (Exception $e) {
        }

        return false;
    }

    protected $fillable = [
        'user_id',
        'path'
    ];
}
