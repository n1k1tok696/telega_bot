<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DbService extends Facade {

  protected static function getFacadeAccessor() {
    return 'dbCheck';
  }

}