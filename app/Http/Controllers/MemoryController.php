<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memories = Auth::user()->memories()->latest()->paginate(10);
        return view('memories.index', compact('memories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('memories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'video_media_path' => 'nullable|string',
            'image_media_path' => 'nullable|string',
            'audio_media_path' => 'nullable|string',
        ]);

        $memory = Auth::user()->memories()->create($validated);

        return redirect()->route('memories.show', $memory)
            ->with('success', 'Memória criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Memory $memory)
    {
        $this->authorize('view', $memory);
        return view('memories.show', compact('memory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memory $memory)
    {
        $this->authorize('update', $memory);
        $categories = Category::all();
        return view('memories.edit', compact('memory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Memory $memory)
    {
        $this->authorize('update', $memory);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'video_media_path' => 'nullable|string',
            'image_media_path' => 'nullable|string',
            'audio_media_path' => 'nullable|string',
        ]);

        $memory->update($validated);

        return redirect()->route('memories.show', $memory)
            ->with('success', 'Memória atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memory $memory)
    {
        $this->authorize('delete', $memory);
        $memory->delete();

        return redirect()->route('memories.index')
            ->with('success', 'Memória excluída com sucesso!');
    }

    public function favorites()
    {
        $memories = Auth::user()->memories()->where('is_favorite', true)->latest()->paginate(10);
        return view('memories.favorites', compact('memories'));
    }
}
