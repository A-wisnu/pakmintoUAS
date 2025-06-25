<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecretCode extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'code',
        'funny_phrase',
        'is_used',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_used' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that owns the secret code.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Determine if the code is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && now()->gt($this->expires_at);
    }
    
    /**
     * Generate a random funny phrase for secret code.
     *
     * @return string
     */
    public static function generateFunnyPhrase(): string
    {
        $funnyPhrases = [
            'Dancing Potato',
            'Laughing Banana',
            'Flying Pizza',
            'Singing Frog',
            'Sleeping Unicorn',
            'Jumping Taco',
            'Running Donut',
            'Smiling Watermelon',
            'Whistling Pancake',
            'Moonwalking Penguin',
            'Breakdancing Turtle',
            'Sneezing Rainbow',
            'Yodeling Pickle',
            'Skateboarding Panda',
            'Giggling Cupcake',
        ];
        
        return $funnyPhrases[array_rand($funnyPhrases)];
    }
}
