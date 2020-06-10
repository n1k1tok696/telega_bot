<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DbReqServiceProvider extends ServiceProvider {

  public function register() {
    $this->app->bind('dbCheck', 'App\Services\DbRequests');
  }

}