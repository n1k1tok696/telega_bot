<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    public function user() {
        return $this->belongs_to('TelegramUser');
    }
}
