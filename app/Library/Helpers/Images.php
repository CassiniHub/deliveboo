<?php

namespace App\Library\Helpers;

class Images {    
    public function getImgName($input, $requestName) {
        $img = $input ->file($requestName);
        $imgExt = $img ->getClientOriginalExtension();
        $imgNewName = time() . rand(1,1000) . '.' . $imgExt;
        return $imgNewName;
    }

    public function deleteRestaurantImgs($logo, $cover) {  
        $src1 = Storage::path("images/restaurants/logo". $logo);
        if (File::exists($src)) {
            File::delete($src);
        }

        $src2 = Storage::path("images/restaurants/cover". $cover);
        if (File::exists($src2)) {
            File::delete($src2);
        }
    }
}