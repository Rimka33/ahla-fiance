<?php

namespace App\Helpers;

use App\Models\Media;

class ImageHelper
{
    /**
     * Récupère l'URL d'une image statique depuis la base de données
     * Si l'image n'existe pas en base, retourne le chemin par défaut
     * 
     * @param string $filename Nom du fichier (ex: 'logo.png')
     * @param string|null $default Chemin par défaut si l'image n'est pas trouvée
     * @return string URL de l'image
     */
    public static function getStaticImage($filename, $default = null)
    {
        $filePath = 'images/' . $filename;
        
        $media = Media::where('file_path', $filePath)
            ->where('file_type', 'image')
            ->first();
        
        if ($media) {
            return asset($media->file_path);
        }
        
        // Retourner le chemin par défaut ou le chemin original
        return $default ? asset($default) : asset($filePath);
    }

    /**
     * Récupère les métadonnées d'une image statique
     * 
     * @param string $filename Nom du fichier
     * @return Media|null
     */
    public static function getStaticImageMeta($filename)
    {
        $filePath = 'images/' . $filename;
        
        return Media::where('file_path', $filePath)
            ->where('file_type', 'image')
            ->first();
    }

    /**
     * Récupère l'URL d'une image avec fallback
     * 
     * @param string $filename Nom du fichier
     * @param string|null $fallback Chemin de fallback
     * @return string URL de l'image
     */
    public static function image($filename, $fallback = null)
    {
        return self::getStaticImage($filename, $fallback);
    }
}

