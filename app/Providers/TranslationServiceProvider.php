<?php

namespace App\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\FileLoader;

class TranslationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new class($app['files'], $app->langPath()) extends FileLoader {
                protected function loadNamespaceFromJSON($locale, $group, $namespace)
                {
                    return parent::loadNamespaceFromJSON($locale, $group, $namespace);
                }

                protected function loadNamespaceOverrides($locale, $group, $namespace)
                {
                    return parent::loadNamespaceOverrides($locale, $group, $namespace);
                }

                protected function loadPaths($locale, $group)
                {
                    if ($group === 'messages') {
                        $path = "{$this->path}/{$locale}.php";
                        if ($this->files->exists($path)) {
                            return $this->files->getRequire($path);
                        }
                    }
                    return parent::loadPaths($locale, $group);
                }
            };
        });
    }
}
