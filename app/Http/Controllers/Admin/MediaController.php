<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->get('path', 'public');
        $search = $request->get('search');

        $files = [];
        $directories = [];

        try {
            $disk = Storage::disk('public');

            // Lister les fichiers et dossiers
            $items = $disk->allFiles($path);

            foreach ($items as $item) {
                $fileInfo = [
                    'name' => basename($item),
                    'path' => $item,
                    'url' => Storage::url($item),
                    'size' => $disk->size($item),
                    'mimeType' => $disk->mimeType($item),
                    'lastModified' => $disk->lastModified($item),
                    'isImage' => str_starts_with($disk->mimeType($item), 'image/'),
                ];

                if ($search && !str_contains(strtolower($fileInfo['name']), strtolower($search))) {
                    continue;
                }

                $files[] = $fileInfo;
            }

            // Trier par date de modification
            usort($files, function($a, $b) {
                return $b['lastModified'] <=> $a['lastModified'];
            });
        } catch (\Exception $e) {
            // Erreur de lecture
        }

        return view('admin.media.index', compact('files', 'path', 'search'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'folder' => 'nullable|string',
        ]);

        $folder = $request->input('folder', 'uploads');

        try {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folder, $filename, 'public');

            return response()->json([
                'success' => true,
                'message' => 'Fichier uploadé avec succès',
                'path' => $path,
                'url' => Storage::url($path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'upload: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($path)
    {
        try {
            $decodedPath = urldecode($path);
            Storage::disk('public')->delete($decodedPath);

            return redirect()->route('admin.media.index')->with('success', 'Fichier supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('admin.media.index')->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Récupère les images de la bibliothèque en JSON (pour le sélecteur d'images)
     */
    public function getImages(Request $request)
    {
        $path = $request->get('path', 'public');
        $search = $request->get('search');

        $files = [];

        try {
            $disk = Storage::disk('public');

            // Lister les fichiers et dossiers
            $items = $disk->allFiles($path);

            foreach ($items as $item) {
                $mimeType = $disk->mimeType($item);

                // Filtrer uniquement les images
                if (!str_starts_with($mimeType, 'image/')) {
                    continue;
                }

                $fileInfo = [
                    'name' => basename($item),
                    'path' => $item,
                    'url' => Storage::url($item),
                    'size' => $disk->size($item),
                    'mimeType' => $mimeType,
                    'lastModified' => $disk->lastModified($item),
                ];

                if ($search && !str_contains(strtolower($fileInfo['name']), strtolower($search))) {
                    continue;
                }

                $files[] = $fileInfo;
            }

            // Trier par date de modification
            usort($files, function($a, $b) {
                return $b['lastModified'] <=> $a['lastModified'];
            });
        } catch (\Exception $e) {
            // Erreur de lecture
        }

        return response()->json([
            'success' => true,
            'images' => $files
        ]);
    }
}
