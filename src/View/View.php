<?php

namespace App\View;

use \GuzzleHttp\Psr7\LazyOpenStream;

class View 
{
    private $pathView;

    public function __construct() {
        $this->pathView = __DIR__ . "/";
    }

    public function response($view) {
        return new LazyOpenStream(($this->pathView . $view), 'r');
    }
}