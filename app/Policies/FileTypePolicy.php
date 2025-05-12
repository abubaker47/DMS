<?php

namespace App\Policies;

use App\Models\FileType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FileTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin(); // All users can view file types
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FileType $fileType): bool
    {
        return $user->isAdmin(); // All users can view file types
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin(); // Only admins can create file types
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FileType $fileType): bool
    {
        return $user->isAdmin(); // Only admins can update file types
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FileType $fileType): bool
    {
        return $user->isAdmin(); // Only admins can delete file types
    }
}
