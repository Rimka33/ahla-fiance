<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class StaticImageController extends Controller
{
    /**
     * Crée une nouvelle image statique
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'image_name' => 'required|string',
            'file_path' => 'required|string',
        ]);

        // Vérifier que le chemin est bien dans images/
        if (!str_starts_with($validated['file_path'], 'images/')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Le chemin doit commencer par images/.'
                ], 400);
            }
            return redirect()->back()
                ->with('error', 'Le chemin doit commencer par images/.');
        }

        // Vérifier si l'image existe déjà
        $existingMedia = Media::where('file_path', $validated['file_path'])
            ->where('file_type', 'image')
            ->first();

        if ($existingMedia) {
            // Si elle existe, utiliser la méthode update
            return $this->update($request, $existingMedia);
        }

        // Gérer l'upload de la nouvelle image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = basename($validated['file_path']);
            $newPath = public_path('images/' . $filename);
            
            // S'assurer que le répertoire existe
            $directory = dirname($newPath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            
            // Copier le fichier temporaire vers la destination
            File::copy($file->getPathname(), $newPath);

            // Créer l'entrée dans la base de données
            $title = ucfirst(str_replace(['_', '-'], ' ', pathinfo($filename, PATHINFO_FILENAME)));
            
            $media = Media::create([
                'title' => $title,
                'file_path' => $validated['file_path'],
                'file_type' => 'image',
                'mime_type' => mime_content_type($newPath),
                'file_size' => File::size($newPath),
                'alt_text' => $title,
                'description' => "Image statique: {$filename}",
            ]);

            // Vider le cache Laravel
            Cache::flush();

            // Si c'est une requête AJAX, retourner JSON
            if ($request->ajax() || $request->wantsJson()) {
                // Ajouter un paramètre de cache busting amélioré à l'URL
                $cacheBuster = $media->updated_at->timestamp;
                $hash = md5($media->file_path . $cacheBuster);
                $imageUrl = asset($media->file_path) . '?v=' . $cacheBuster . '&h=' . substr($hash, 0, 8);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Image uploadée avec succès.',
                    'image' => [
                        'id' => $media->id,
                        'title' => $media->title,
                        'alt_text' => $media->alt_text,
                        'file_path' => $media->file_path,
                        'url' => $imageUrl,
                        'updated_at' => $media->updated_at->timestamp
                    ]
                ]);
            }

            return redirect()->back()
                ->with('success', 'Image uploadée avec succès.');
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune image n\'a été fournie.'
            ], 400);
        }

        return redirect()->back()
            ->with('error', 'Aucune image n\'a été fournie.');
    }

    /**
     * Met à jour les informations d'une image
     */
    public function update(Request $request, Media $staticImage)
    {
        // Vérifier que c'est bien une image statique
        if (!str_starts_with($staticImage->file_path, 'images/')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette image n\'est pas une image statique.'
                ], 400);
            }
            return redirect()->back()
                ->with('error', 'Cette image n\'est pas une image statique.');
        }

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
        ]);

        // Gérer le remplacement de l'image
        if ($request->hasFile('image')) {
            $oldPath = public_path($staticImage->file_path);
            
            // Sauvegarder la nouvelle image
            $file = $request->file('image');
            $filename = basename($staticImage->file_path);
            $newPath = public_path('images/' . $filename);
            
            // S'assurer que le répertoire existe
            $directory = dirname($newPath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            
            // Supprimer l'ancienne image si elle existe (avant de copier la nouvelle)
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            
            // Déplacer le fichier temporaire vers la destination (plus fiable que copy)
            try {
                $file->move($directory, $filename);
            } catch (\Exception $e) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors du déplacement du fichier: ' . $e->getMessage()
                    ], 500);
                }
                return redirect()->back()
                    ->with('error', 'Erreur lors du déplacement du fichier: ' . $e->getMessage());
            }
            
            // Vérifier que le fichier a bien été copié et est accessible
            if (!File::exists($newPath) || !is_readable($newPath)) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Le fichier n\'existe pas ou n\'est pas accessible après la copie.'
                    ], 500);
                }
                return redirect()->back()
                    ->with('error', 'Le fichier n\'existe pas ou n\'est pas accessible après la copie.');
            }

            // Mettre à jour les métadonnées
            $staticImage->file_size = File::size($newPath);
            $staticImage->mime_type = mime_content_type($newPath);
            
            // Forcer la mise à jour du timestamp du fichier pour le cache busting
            @touch($newPath);
        }
        
        // Toujours mettre à jour le timestamp pour forcer le rechargement (même si pas de nouveau fichier)
        $staticImage->touch(); // Met à jour updated_at à maintenant
        $staticImage->save();
        
        // Rafraîchir le modèle depuis la base de données pour avoir le bon timestamp
        $staticImage->refresh();
        
        // Vider TOUS les caches Laravel (y compris les caches de requêtes)
        Cache::flush();
        
        // Vider aussi le cache de requêtes Eloquent si disponible
        if (method_exists(\Illuminate\Database\Eloquent\Model::class, 'clearBootedModels')) {
            \Illuminate\Database\Eloquent\Model::clearBootedModels();
        }

        // Si c'est une requête AJAX, retourner JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Ajouter un paramètre de cache busting amélioré à l'URL
            $cacheBuster = $staticImage->updated_at->timestamp;
            $hash = md5($staticImage->file_path . $cacheBuster);
            $imageUrl = asset($staticImage->file_path) . '?v=' . $cacheBuster . '&h=' . substr($hash, 0, 8);
            
            return response()->json([
                'success' => true,
                'message' => 'Image mise à jour avec succès.',
                'image' => [
                    'id' => $staticImage->id,
                    'title' => $staticImage->title,
                    'alt_text' => $staticImage->alt_text,
                    'file_path' => $staticImage->file_path,
                    'url' => $imageUrl,
                    'updated_at' => $staticImage->updated_at->timestamp
                ]
            ]);
        }

        return redirect()->back()
            ->with('success', 'Image mise à jour avec succès.');
    }

    /**
     * Supprime une image statique
     */
    public function destroy(Request $request, Media $staticImage)
    {
        // Vérifier que c'est bien une image statique
        if (!str_starts_with($staticImage->file_path, 'images/')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette image n\'est pas une image statique.'
                ], 400);
            }
            return redirect()->back()
                ->with('error', 'Cette image n\'est pas une image statique.');
        }

        $filePath = public_path($staticImage->file_path);
        
        // Supprimer le fichier physique
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Supprimer l'entrée de la base de données
        $staticImage->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès.'
            ]);
        }

        return redirect()->back()
            ->with('success', 'Image supprimée avec succès.');
    }
}
