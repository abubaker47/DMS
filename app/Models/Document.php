<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_name',
        'original_file_name',
        'file_path',
        'file_type_id',
        'from_department_id',
        'to_department_id',
        'created_by',
        'description',
        'description_dari',
        'description_pashto',
        'status',
        'assigned_at',
        'viewed_at',
        'completed_at',
        'encryption_key',
        'encryption_iv',
        'is_encrypted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'assigned_at' => 'datetime',
        'viewed_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_encrypted' => 'boolean',
    ];

    /**
     * Get the file type that the document belongs to.
     */
    public function fileType(): BelongsTo
    {
        return $this->belongsTo(FileType::class);
    }

    /**
     * Get the department that sent the document.
     */
    public function fromDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    /**
     * Get the department that received the document.
     */
    public function toDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }

    /**
     * Get the user that created the document.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the document histories for the document.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(DocumentHistory::class);
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
     * Scope a query to only include documents for a specific department.
     */
    public function scopeForDepartment($query, $departmentId)
    {
        return $query->where('to_department_id', $departmentId)
                     ->orWhere('from_department_id', $departmentId);
    }

    /**
     * Scope a query to only include pending documents.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include received documents.
     */
    public function scopeReceived($query)
    {
        return $query->where('status', 'received');
    }

    /**
     * Scope a query to only include completed documents.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include rejected documents.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
