<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Document;
use App\Models\FileType;
use App\Models\User;
use App\Policies\DepartmentPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\FileTypePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Department::class => DepartmentPolicy::class,
        Document::class => DocumentPolicy::class,
        FileType::class => FileTypePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
