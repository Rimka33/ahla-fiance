<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filtre par statut
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Recherche
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('question', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(15);
        $stats = [
            'new' => ContactMessage::where('status', 'new')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
            'archived' => ContactMessage::where('status', 'archived')->count(),
        ];

        return view('admin.inbox.index', compact('messages', 'stats'));
    }

    public function show(ContactMessage $message)
    {
        // Marquer comme lu si nouveau
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }

        return view('admin.inbox.show', compact('message'));
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'response' => 'required|string',
            'send_email' => 'boolean',
        ]);

        $message->update([
            'admin_response' => $validated['response'],
            'replied_at' => now(),
            'replied_by' => Auth::id(),
            'status' => 'replied',
        ]);

        // Envoyer email si demandé
        if ($request->boolean('send_email')) {
            // Ici vous pouvez implémenter l'envoi d'email
            // Mail::to($message->email)->send(new ContactReplyMail($message));
        }

        return redirect()->route('admin.inbox.show', $message)->with('success', 'Réponse enregistrée avec succès.');
    }

    public function publishFaq(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
        ]);

        $faq = FaqQuestion::create([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category' => $validated['category'],
            'client_email' => $message->email,
            'contact_message_id' => $message->id,
            'status' => 'published',
            'is_published' => true,
            'answered_at' => now(),
        ]);

        $message->update([
            'published_in_faq' => true,
            'admin_response' => $validated['answer'],
            'status' => 'replied',
            'replied_by' => Auth::id(),
            'replied_at' => now(),
        ]);

        // Invalider le cache des FAQs publiées
        Cache::forget('faq_published');

        return redirect()->route('admin.inbox.show', $message)->with('success', 'Question publiée dans la FAQ avec succès.');
    }

    public function archive(ContactMessage $message)
    {
        $message->update(['status' => 'archived']);
        return redirect()->route('admin.inbox.index')->with('success', 'Message archivé avec succès.');
    }

    public function markRead(ContactMessage $message)
    {
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }
        return back()->with('success', 'Message marqué comme lu.');
    }
}
