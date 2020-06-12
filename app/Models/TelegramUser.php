<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class TelegramUser extends Model implements Authenticatable
{
    use AuthenticableTrait;
    public function revenue() {
        return $this->hasMany('App\Models\Pay');
    }
}
