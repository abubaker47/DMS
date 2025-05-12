<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
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
        'description',
        'description_dari',
        'description_pashto',
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
     * Get the users that belong to the department.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the documents sent from this department.
     */
    public function sentDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'from_department_id');
    }

    /**
     * Get the documents received by this department.
     */
    public function receivedDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'to_department_id');
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

    /**
     * Get the description based on the language.
     */
    public function getLocalizedDescription(string $language = 'en'): ?string
    {
        return match ($language) {
            'dari' => $this->description_dari ?: $this->description,
            'pashto' => $this->description_pashto ?: $this->description,
            default => $this->description,
        };
    }

    /**
     * Get the translation for a given attribute.
     */
    public function getTranslation(string $attribute, string $locale = 'en'): string|null
    {
        if ($attribute === 'name') {
            return match ($locale) {
                'dari' => $this->name_dari ?: $this->name,
                'pashto' => $this->name_pashto ?: $this->name,
                default => $this->name,
            };
        } elseif ($attribute === 'description') {
            return match ($locale) {
                'dari' => $this->description_dari ?: $this->description,
                'pashto' => $this->description_pashto ?: $this->description,
                default => $this->description,
            };
        }

        return $this->$attribute;
    }
}
