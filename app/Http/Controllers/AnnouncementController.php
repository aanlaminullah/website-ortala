<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    // -------------------------------------------------------
    // PUBLIK
    // -------------------------------------------------------
    public function index()
    {
        $announcements = Announcement::orderBy('date', 'desc')->get();

        return view('announcements.index', compact('announcements'));
    }

    // -------------------------------------------------------
    // ADMIN CRUD
    // -------------------------------------------------------
    public function adminIndex()
    {
        $announcements = Announcement::orderBy('date', 'desc')->paginate(10);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'date'        => 'required|date',
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'attachment.mimes' => 'Format lampiran harus PDF, DOC, atau DOCX.',
            'attachment.max'   => 'Ukuran lampiran maksimal 5MB.',
        ]);

        $validated['date'] = now();

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')
                ->store('announcements', 'public');
        }

        Announcement::create($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string',
            'date'        => 'required|date',
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'attachment.mimes' => 'Format lampiran harus PDF, DOC, atau DOCX.',
            'attachment.max'   => 'Ukuran lampiran maksimal 5MB.',
        ]);

        $validated['date'] = now();

        if ($request->hasFile('attachment')) {
            // Hapus file lama jika ada
            if ($announcement->attachment) {
                Storage::disk('public')->delete($announcement->attachment);
            }
            $validated['attachment'] = $request->file('attachment')
                ->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function removeAttachment(Announcement $announcement)
    {
        if ($announcement->attachment) {
            Storage::disk('public')->delete($announcement->attachment);
            $announcement->update(['attachment' => null]);
        }

        return redirect()
            ->route('admin.announcements.edit', $announcement->id)
            ->with('success', 'Lampiran berhasil dihapus.');
    }

    public function destroy(Announcement $announcement)
    {
        // Hapus file lampiran jika ada
        if ($announcement->attachment) {
            Storage::disk('public')->delete($announcement->attachment);
        }

        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
