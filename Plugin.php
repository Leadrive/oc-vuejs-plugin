<?php namespace Terne\Vuejs;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerSettings()
    {
    }

    public function registerComponents()
    {
        return [
           '\Terne\VueJs\Components\Layout'     => 'vueLayout',
        ];
    }

    public function boot()
    {
        //page.beforeDisplay
        /*
        \Event::listen('page.beforeDisplay', function($url, $page) {
            dd('111');
            if (\Request::ajax()) {
                $page->layout = null;
                dd($page);
                return $page;
            }
        });
        */

        \Event::listen('cms.page.display', function($controller, $url, $page) {
            if (
                \Request::ajax() &&
                $controller->getAjaxHandler() === null
            ) {
                if ($content = $controller->renderPage()) {
                    return $content;
                }

                // If we don't return something, this will cause an infinite loop
                return '<!-- No content -->';
            }
        });
    }

}
