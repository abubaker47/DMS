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
                            $result = $this->files->getRequire($path);
                            // Ensure the result is an array
                            if (is_array($result)) {
                                return $result;
                            }
                            // If not an array, return an empty array to prevent errors
                            return [];
                        }
                    }
                    return parent::loadPaths($locale, $group);
                }
            };
        });
    }
}
