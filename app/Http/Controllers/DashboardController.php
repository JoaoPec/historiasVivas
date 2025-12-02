<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->memories();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by favorite
        if ($request->boolean('favorite')) {
            $query->where('is_favorite', true);
        }

        // Filter by time period
        if ($request->filled('time_period')) {
            $now = Carbon::now();
            switch ($request->time_period) {
                case 'today':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'week':
                    $query->where('created_at', '>=', $now->copy()->subWeek());
                    break;
                case 'month':
                    $query->where('created_at', '>=', $now->copy()->subMonth());
                    break;
                case 'year':
                    $query->where('created_at', '>=', $now->copy()->subYear());
                    break;
            }
        }

        // Filter by media type
        if ($request->filled('media_type')) {
            switch ($request->media_type) {
                case 'image':
                    $query->whereNotNull('image_media_path');
                    break;
                case 'video':
                    $query->whereNotNull('video_media_path');
                    break;
                case 'audio':
                    $query->whereNotNull('audio_media_path');
                    break;
            }
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'title':
                    $query->orderBy('title');
                    break;
                case 'event_date':
                    $query->orderBy('event_date', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $memories = $query->paginate(9)->withQueryString();

        // Stats
        $totalMemories = $user->memories()->count();
        $favoriteMemories = $user->memories()->where('is_favorite', true)->count();
        $mediaMemories = $user->memories()
            ->where(function($query) {
                $query->whereNotNull('image_media_path')
                      ->orWhereNotNull('video_media_path')
                      ->orWhereNotNull('audio_media_path');
            })
            ->count();
        $monthlyMemories = $user->memories()
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Get all categories for the filter dropdown
        $categories = Category::orderBy('name')->get();

        return view('dashboard', compact(
            'memories',
            'totalMemories',
            'favoriteMemories',
            'mediaMemories',
            'monthlyMemories',
            'categories'
        ));
    }
} 