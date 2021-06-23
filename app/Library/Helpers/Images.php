<?php

namespace App\Library\Helpers;

use Illuminate\Support\Facades\Storage;
use File;


class Images {    
    public function getImgName($input, $requestName) {
        $img = $input ->file($requestName);
        $imgExt = $img ->getClientOriginalExtension();
        $imgNewName = time() . rand(1,1000) . '.' . $imgExt;
        return $imgNewName;
    }

    public function deleteRestaurantLogo($logo) {  
        $src = Storage::path("images/restaurants/logo/". $logo);
        if (File::exists($src)) {
            File::delete($src);
        }
    }
    
    public function deleteRestaurantCover($cover) {
        $src = Storage::path("images/restaurants/cover/". $cover);
        if (File::exists($src)) {
            File::delete($src);
        }
    }

    public function deleteDishImg($img) {
        $src = Storage::path("images/dishes". $img);
        if (File::exists($src)) {
            File::delete($src);
        }
    }
}