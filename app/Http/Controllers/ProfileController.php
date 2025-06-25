<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('profile.show', Auth::user()->profile ?? Auth::id());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed as profile is created when user registers
        return redirect()->route('profile.edit', Auth::user()->profile ?? Auth::id());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not needed as profile is created when user registers
        return redirect()->route('profile.edit', Auth::user()->profile ?? Auth::id());
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $user = $profile->user;
        $memes = $user->memes()->orderBy('created_at', 'desc')->paginate(12);
        
        return view('profiles.show', compact('profile', 'user', 'memes'));
    }
    
    /**
     * Display profile by user ID.
     */
    public function showByUser(User $user)
    {
        // Create profile if doesn't exist
        if (!$user->profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();
            
            // Refresh to get the created profile
            $user->refresh();
        }
        
        return $this->show($user->profile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $validator = Validator::make($request->all(), [
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($profile->profile_picture) {
                $oldPath = str_replace('/storage/', '', $profile->profile_picture);
                Storage::disk('public')->delete($oldPath);
            }
            
            // Store new image
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $profile->profile_picture = Storage::url($path);
        }
        
        $profile->bio = $request->bio;
        $profile->save();

        return redirect()->route('profile.show', $profile)
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        // Not allowing profile deletion, only user accounts can be deleted
        return redirect()->route('profile.show', $profile);
    }
}
