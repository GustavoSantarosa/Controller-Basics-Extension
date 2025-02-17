<?php

namespace GustavoSantarosa\ControllerBasicsExtension\Providers;

use Illuminate\Support\ServiceProvider;

class EnhancedResourceProvider extends ServiceProvider
{
    /**
     * Add the restore method for a resource.
     *
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array  $options
     *
     * @return void
     */
    protected function addResourceRestore($name, $base, $controller, $options)
    {
        $this->router->post("{$name}/{id}/restore", [
            'as'   => "{$name}.restore",
            'uses' => "{$controller}@restore",
        ]);
    }

    /**
     * Add the summary method for a resource.
     *
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array  $options
     *
     * @return void
     */
    protected function addResourceSummary($name, $base, $controller, $options)
    {
        $this->router->get("{$name}/summary", [
            'as'   => "{$name}.summary",
            'uses' => "{$controller}@summary",
        ]);
    }

    /**
     * Add the default resource routes to the router.
     *
     * @param string $name
     * @param string $controller
     *
     * @return void
     */
    public function register($name, $controller, array $options = [])
    {
        parent::register($name, $controller, $options);

        $this->addResourceRestore($name, $this->getResourceWildcard($name), $controller, $options);
        $this->addResourceSummary($name, $this->getResourceWildcard($name), $controller, $options);
    }
}
