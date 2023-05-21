<?php

namespace App\Helpers;

class Helper
{
    public static function makeImageFromName($name) {
        $shortName = "";

        $names = explode(" ", $name);

        foreach ($names as $w) {
            $shortName .= $w[0];
        }

        return '<div class="name-image bg-primary">'.$shortName.'</div>';
    }
}
