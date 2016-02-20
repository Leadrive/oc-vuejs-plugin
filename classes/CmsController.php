<?php namespace Terne\VueJs\Classes;

use Cms\Classes\CmsController as CmsControllerBase;

class CmsController extends CmsControllerBase
{
    public function run($url = '/')
    {
        return App::make('Terne\VueJs\Classes\Controller')->run($url);
    }
}
