<?php 

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\TelegramUser;
use App\Models\Log;
use App\Models\Pay;

use Carbon\Carbon;

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

  public function saveMessageToLog($array) {

    $message = new Log;

    $message->telegram_user_id = $array['message']['from']['id'];
    $message->telegram_message_id = $array['update_id'];
    $message->text = $array['message']['text'];

    $message->save();
  }

  public function getLastMessageId() {
    $lastMessageId = Log::latest('telegram_message_id')->first();
    if ($lastMessageId) {
      return $lastMessageId['telegram_message_id'] + 1;
    } else {
      return null;
    }
  }

  public function addUserPay($userId, $userRequest) {
    // dd($userRequest);
    $date = Carbon::now();

    $type = $userRequest[1];
    $category = $userRequest[2];
    $name = $userRequest[3];
    $amount = $userRequest[4];
    $dateTime = isset($userRequest[5]) ? $userRequest[5] : $date->format('Y-m-d H:i:s');
    
    // [$command, $type, $category, $name, $amount] = $userRequest;

    $pay = new Pay;
    $user = TelegramUser::where('telegram_user_id', '=', $userId)->first();

    $pay->user_id = $user->id;
    $pay->type = $type;
    $pay->category = $category;
    $pay->name = $name;
    $pay->amount = $amount;
    $pay->dateTime = $dateTime;

    $pay->save();
  }

  public function deleteUserPay($receiptId) {
    
  }
}