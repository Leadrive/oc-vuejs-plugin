<?php namespace Terne\VueJs\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

class Layout extends ComponentBase
{
    /**
     * @var array Collection of pages that belong to this layout.
     */
    public $pages;

    public function componentDetails()
    {
        return [
            'name'        => 'Layout Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->pages = $this->page['pages'] = Page::all();
    }
}
