<?php

namespace App\Http\Controllers;

use App\Models\SecretCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SecretCodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['verify', 'login']);
    }

    /**
     * Display a listing of the secret codes.
     */
    public function index()
    {
        $secretCodes = Auth::user()->secretCodes()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('secret-codes.index', compact('secretCodes'));
    }

    /**
     * Generate a new secret code for user.
     */
    public function generate()
    {
        $user = Auth::user();
        
        // Check if user already has active codes
        $activeCodes = $user->secretCodes()
            ->where('is_used', false)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->count();
            
        if ($activeCodes >= 3) {
            return redirect()->route('secret-codes.index')
                ->with('error', 'You already have 3 active secret codes. Please use or expire them first.');
        }
        
        $secretCode = new SecretCode();
        $secretCode->user_id = $user->id;
        $secretCode->code = strtoupper(Str::random(8));
        $secretCode->funny_phrase = SecretCode::generateFunnyPhrase();
        $secretCode->expires_at = Carbon::now()->addDays(7); // Expires in 7 days
        $secretCode->save();
        
        return redirect()->route('secret-codes.index')
            ->with('success', 'New secret code generated successfully!');
    }

    /**
     * Invalidate a secret code.
     */
    public function invalidate(SecretCode $secretCode)
    {
        $this->authorize('update', $secretCode);
        
        $secretCode->is_used = true;
        $secretCode->save();
        
        return redirect()->route('secret-codes.index')
            ->with('success', 'Secret code invalidated successfully!');
    }
    
    /**
     * Show the secret code verification form.
     */
    public function verify()
    {
        return view('secret-codes.verify');
    }
    
    /**
     * Show the secret code login form.
     */
    public function showLoginForm()
    {
        return view('secret-codes.login');
    }
    
    /**
     * Login using secret code.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:8',
            'funny_phrase' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Find the secret code
        $secretCode = SecretCode::where('code', $request->code)
            ->where('funny_phrase', $request->funny_phrase)
            ->where('is_used', false)
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->first();
            
        if (!$secretCode) {
            return redirect()->back()
                ->with('error', 'Invalid or expired secret code.')
                ->withInput();
        }
        
        // Mark code as used
        $secretCode->is_used = true;
        $secretCode->save();
        
        // Login the user
        Auth::login($secretCode->user);
        
        return redirect()->intended(route('home'))
            ->with('success', 'Logged in successfully with secret code!');
    }
}
