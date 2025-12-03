<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filtre par statut
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $subscribers = $query->latest()->paginate(20)->withQueryString();

        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscriber $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletter.index')->with('success', 'Abonné supprimé avec succès.');
    }

    public function toggleStatus(NewsletterSubscriber $newsletter)
    {
        $newsletter->is_active = !$newsletter->is_active;
        if (!$newsletter->is_active) {
            $newsletter->unsubscribed_at = now();
        } else {
            $newsletter->subscribed_at = now();
            $newsletter->unsubscribed_at = null;
        }
        $newsletter->save();

        return redirect()->back()->with('success', 'Statut modifié avec succès.');
    }

    public function export()
    {
        $subscribers = NewsletterSubscriber::where('is_active', true)->get();

        $filename = 'newsletter_subscribers_' . now()->format('Y-m-d') . '.csv';
        $filepath = storage_path('app/temp/' . $filename);

        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $file = fopen($filepath, 'w');

        // En-têtes
        fputcsv($file, ['Email', 'Nom', 'Date d\'inscription', 'Statut']);

        // Données
        foreach ($subscribers as $subscriber) {
            fputcsv($file, [
                $subscriber->email,
                $subscriber->name ?? '',
                $subscriber->subscribed_at ? $subscriber->subscribed_at->format('Y-m-d H:i:s') : '',
                $subscriber->is_active ? 'Actif' : 'Inactif'
            ]);
        }

        fclose($file);

        return response()->download($filepath, $filename)->deleteFileAfterSend(true);
    }
}
