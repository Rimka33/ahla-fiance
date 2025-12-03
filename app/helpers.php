<?php

use App\Models\Media;

if (!function_exists('static_image')) {
    /**
     * Récupère l'URL d'une image statique depuis la base de données
     * 
     * @param string $filename Nom du fichier (ex: 'logo.png')
     * @param string|null $default Chemin par défaut si l'image n'est pas trouvée
     * @return string URL de l'image avec cache busting
     */
    function static_image($filename, $default = null)
    {
        $filePath = 'images/' . $filename;
        
        // Utiliser withoutGlobalScopes() pour forcer la récupération depuis la base de données (sans cache)
        $media = Media::withoutGlobalScopes()
            ->where('file_path', $filePath)
            ->where('file_type', 'image')
            ->first();
        
        if ($media) {
            // Vérifier si le fichier existe physiquement
            $physicalPath = public_path($media->file_path);
            $fileTimestamp = file_exists($physicalPath) ? filemtime($physicalPath) : time();
            
            // Utiliser le timestamp du fichier ET celui de la base de données pour un cache busting maximal
            $dbTimestamp = $media->updated_at ? $media->updated_at->timestamp : time();
            $cacheBuster = max($dbTimestamp, $fileTimestamp);
            
            // Ajouter aussi un hash du nom de fichier pour plus de sécurité
            $hash = md5($media->file_path . $cacheBuster . $fileTimestamp);
            return asset($media->file_path) . '?v=' . $cacheBuster . '&h=' . substr($hash, 0, 8) . '&t=' . $fileTimestamp;
        }
        
        // Retourner le chemin par défaut ou le chemin original
        return $default ? asset($default) : asset($filePath);
    }
}

if (!function_exists('static_image_meta')) {
    /**
     * Récupère les métadonnées d'une image statique
     * 
     * @param string $filename Nom du fichier
     * @return Media|null
     */
    function static_image_meta($filename)
    {
        $filePath = 'images/' . $filename;
        
        return Media::where('file_path', $filePath)
            ->where('file_type', 'image')
            ->first();
    }
}

