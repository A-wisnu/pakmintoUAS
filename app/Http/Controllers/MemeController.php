<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'reels', 'feed']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memes = Meme::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('welcome', compact('memes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,video',
            'source' => 'required|in:instagram,tiktok,upload',
            'content' => $request->source === 'upload' ? 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240' : 'nullable',
            'content_url' => $request->source !== 'upload' ? 'required|url' : 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $meme = new Meme();
        $meme->user_id = Auth::id();
        $meme->title = $request->title;
        $meme->type = $request->type;
        $meme->source = $request->source;

        if ($request->source === 'upload' && $request->hasFile('content')) {
            $path = $request->file('content')->store('memes', 'public');
            $meme->content_url = Storage::url($path);
        } else {
            $meme->content_url = $request->content_url;
        }

        $meme->save();

        return redirect()->route('memes.show', $meme)
            ->with('success', 'Meme created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meme $meme)
    {
        // Increment view count
        $meme->increment('views');
        
        return view('memes.show', compact('meme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meme $meme)
    {
        $this->authorize('update', $meme);
        
        return view('memes.edit', compact('meme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meme $meme)
    {
        $this->authorize('update', $meme);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $meme->title = $request->title;
        $meme->save();

        return redirect()->route('memes.show', $meme)
            ->with('success', 'Meme updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme)
    {
        $this->authorize('delete', $meme);
        
        // If it's an uploaded file, remove it from storage
        if ($meme->source === 'upload') {
            $path = str_replace('/storage/', '', $meme->content_url);
            Storage::disk('public')->delete($path);
        }
        
        $meme->delete();

        return redirect()->route('memes.index')
            ->with('success', 'Meme deleted successfully!');
    }

    /**
     * Like a meme.
     */
    public function like(Meme $meme)
    {
        $meme->increment('likes');
        
        return redirect()->back();
    }

    /**
     * Display feed page with Instagram or TikTok embedded content.
     */
    public function feed()
    {
        $memes = Meme::where('source', '!=', 'upload')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('memes.feed', compact('memes'));
    }

    /**
     * Display reels-style fullscreen meme dashboard.
     */
    public function reels()
    {
        $memes = Meme::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('memes.reels', compact('memes'));
    }
}
