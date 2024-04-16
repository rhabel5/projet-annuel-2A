<?php

namespace App\Helpers;

class PathHelper
{
    public static function public_path($path = '')
    {
        return public_path($path);
    }

    // TODO: Ajouter les autres méthodes de gestion de chemins
}
