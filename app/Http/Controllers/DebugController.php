<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meme;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DebugController extends Controller
{
    public function testView()
    {
        // Create test data
        $memes = Meme::orderBy('created_at', 'desc')->get();
        
        // Return a basic view with HTML output
        return view('debug.test', compact('memes'));
    }
    
    public function plainHtml() 
    {
        $memes = Meme::orderBy('created_at', 'desc')->limit(3)->get();
        
        // Generate plain HTML directly
        $html = '<h1>Debug HTML Output</h1>';
        $html .= '<h2>Memes in Database:</h2>';
        $html .= '<ul>';
        
        foreach ($memes as $meme) {
            $html .= '<li>';
            $html .= 'Title: ' . $meme->title . '<br>';
            $html .= 'URL: ' . $meme->content_url . '<br>';
            if ($meme->type == 'image') {
                $html .= '<img src="' . $meme->content_url . '" style="max-width:300px"><br>';
            }
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        
        return response($html)->header('Content-Type', 'text/html');
    }
    
    public function rawBlade()
    {
        // Get the raw contents of a Blade file
        $path = resource_path('views/memes/index.blade.php');
        $contents = File::get($path);
        
        return response($contents)->header('Content-Type', 'text/plain');
    }
}
