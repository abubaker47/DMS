<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All users can view documents list
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Document $document): bool
    {
        // Admin can view all documents
        if ($user->isAdmin()) {
            return true;
        }
        
        // Users can only view documents related to their department
        return $user->department_id === $document->from_department_id || 
               $user->department_id === $document->to_department_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin and users with a department can create documents
        return $user->isAdmin() || $user->department_id !== null;
    }

    /**
     * Determine whether the user can download the document.
     */
    public function download(User $user, Document $document): bool
    {
        // Same rules as viewing
        return $this->view($user, $document);
    }

    /**
     * Determine whether the user can update the document status.
     */
    public function updateStatus(User $user, Document $document): bool
    {
        // Admin can update any document status
        if ($user->isAdmin()) {
            return true;
        }
        
        // Only users from the receiving department can update status
        return $user->department_id === $document->to_department_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        // Only admin can delete documents
        return $user->isAdmin();
    }
}
