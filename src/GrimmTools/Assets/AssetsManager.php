<?php

namespace GrimmTools\Assets;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\HTML;

class AssetsManager {

    protected $container;

    public function __construct() {
        $this->container = array(
            'css' => array(),
            'js'  => array()
        );
    }

    public function add($file, $group = null) {

        if($group === null) {
            $group = File::extension($file) == 'css' ? 'css' : 'js';
        } else {
            $group = $group == 'css' ? 'css' : 'js';
        }

        $this->container[$group][] = $file;
    }

    public function group($group) {
        if(!isset($this->container[$group])) {
            throw new \InvalidArgumentException('unknown asset group ' . $group);
        }

        $html = '';

        foreach($this->container[$group] as $item) {
            $html.= $this->convert($group, $item);
        }

        return $html;
    }

    protected function convert($group, $item) {
        return $group == 'css' ? HTML::style($item) : HTML::script($item);
    }

    public function scripts() {
        return $this->group('js');
    }

    public function styles() {
        return $this->group('css');
    }
}
