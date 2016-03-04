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
        \Event::listen('cms.page.display', function($controller, $url, $page) {
            //check if page requested by ajax and no handler
            if (
                \Request::ajax() &&
                $controller->getAjaxHandler() === null
            ) {
                //dd($controller);
                $assets = $controller->getAssetPaths();
                $content = $controller->renderPage() ?: '<!-- No content -->';
                $vueComponents = [];
                foreach ($page->components as $component) {
                    if (method_exists($component, 'vueComponents')) {

                        //dd($component->getPath());
                        $vueComponents_chunk = $component->vueComponents();
                        foreach ($vueComponents_chunk as $vcName => $vcOptions) {
                            $vueComponents_chunk[$vcName]['code'] = file_get_contents($component->getPath()."/".$vcOptions['file']);
                        }

                        $vueComponents = array_merge($vueComponents, $vueComponents_chunk);
                    }
                }

                return [
                    'template' => $content,
                    'assets'  => $assets,
                    'components' => $vueComponents,
                ];
            }
        });
    }

}
