<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SyncStaticImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:sync-static';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise les images statiques du dossier public/images/ dans la base de données';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Début de la synchronisation des images statiques...');

        $imagesPath = public_path('images');
        
        if (!File::exists($imagesPath)) {
            $this->error('Le dossier public/images/ n\'existe pas.');
            return 1;
        }

        $imageFiles = File::allFiles($imagesPath);
        $synced = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($imageFiles as $file) {
            $filename = $file->getFilename();
            $extension = strtolower($file->getExtension());
            
            // Vérifier que c'est bien une image
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
            if (!in_array($extension, $imageExtensions)) {
                continue;
            }

            try {
                $filePath = 'images/' . $filename;
                $fullPath = $file->getPathname();
                
                // Vérifier si l'image existe déjà dans la base
                $existingMedia = Media::where('file_path', $filePath)->first();
                
                if ($existingMedia) {
                    // Mettre à jour les informations si nécessaire
                    $fileSize = File::size($fullPath);
                    $mimeType = mime_content_type($fullPath);
                    
                    $existingMedia->update([
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                    ]);
                    
                    $skipped++;
                    $this->line("  ✓ Déjà enregistrée: {$filename}");
                } else {
                    // Créer une nouvelle entrée
                    $fileSize = File::size($fullPath);
                    $mimeType = mime_content_type($fullPath);
                    
                    // Générer un titre à partir du nom du fichier
                    $title = Str::title(str_replace(['_', '-'], ' ', pathinfo($filename, PATHINFO_FILENAME)));
                    
                    Media::create([
                        'title' => $title,
                        'file_path' => $filePath,
                        'file_type' => 'image',
                        'mime_type' => $mimeType,
                        'file_size' => $fileSize,
                        'alt_text' => $title,
                        'description' => "Image statique: {$filename}",
                    ]);
                    
                    $synced++;
                    $this->info("  + Enregistrée: {$filename}");
                }
            } catch (\Exception $e) {
                $errors++;
                $this->error("  ✗ Erreur pour {$filename}: " . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info("Synchronisation terminée:");
        $this->line("  - Nouvelles images enregistrées: {$synced}");
        $this->line("  - Images déjà existantes: {$skipped}");
        if ($errors > 0) {
            $this->warn("  - Erreurs: {$errors}");
        }

        return 0;
    }
}
