<?php 

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\TelegramUser;
use App\Models\Log;
use App\Models\Pay;

class DbRequests {

  public function isUserDefined($username) {

    return TelegramUser::where('username', '=', $username)->first();

  }

  public function addUser($array) {

    $user = new TelegramUser;
    
    $user->telegram_user_id = $array['id'];
    $user->username = $array['username'];
    $user->password = Hash::make($array['username']);
    $user->first_name = $array['first_name'];
    $user->last_name = $array['last_name'];

    $user->save();
    
  }

  public function addResponseMessage($array) {

    $message = new Log;

    $message->telegram_user_id = $array['message']['from']['id'];
    $message->telegram_message_id = $array['update_id'];
    $message->text = $array['message']['text'];

    $message->save();
  }

  public function getLastMessageId() {
    return Log::latest()->first();
  }

  public function addUserPay() {
    $pay = new Pay;
    $user = new TelegramUser;

    $pay->user_id = TelegramUser::find(1)->revenue()->first();
    $pay->type = 'type';
    $pay->category = 'category';
    $pay->name = 'name';
    $pay->amount = 'amount';

    $pay->save();
  }
}