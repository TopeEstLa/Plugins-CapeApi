<?php

namespace Azuriom\Plugin\CapeApi\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;

class CapeApiServiceProvider extends BasePluginServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerMiddlewares();
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews();

        $this->loadTranslations();

        // $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'cape-api.home' => 'cape-api::messages.title',
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'cape-api' => [
                'name' => 'Cape-Api',
                'type' => 'dropdown',
                'icon' => 'fas fa-user-circle',
                'route' => 'cape-api.admin.*',
                'items' => [
                    'cape-api.admin.home' => 'admin.nav.settings.settings.settings',
                ],
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            'cape' => [
                'route' => 'cape-api.home',
                'name' => 'cape-api::messages.title',
            ],
        ];
    }
}