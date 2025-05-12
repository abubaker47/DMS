<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_dari',
        'name_pashto',
        'extension',
        'mime_type',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the documents that belong to this file type.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the name based on the language.
     */
    public function getLocalizedName(string $language = 'en'): string
    {
        return match ($language) {
            'dari' => $this->name_dari ?: $this->name,
            'pashto' => $this->name_pashto ?: $this->name,
            default => $this->name,
        };
    }
}
