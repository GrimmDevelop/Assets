<?php

namespace GrimmTools\Assets;

use Illuminate\Support\Facades\Facade;

class Assets extends Facade {

    protected static function getFacadeAccessor() { return 'grimmtools.assets'; }

}