<?php 

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\TelegramUser;
use App\Models\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

use DbService;

class State {

  public function getFromTelegram() {

    $last = DbService::getLastMessageId();
    
    $last ? $offsetIndex = $last['telegram_message_id'] + 1 : $offsetIndex = 0;
    $params = [ 'offset' => $offsetIndex];

    $data = Telegram::getUpdates($params); 

    for ($i=0; $i < count($data); $i++) {

      $this->saveMessage($data[$i]);

      $isNewUser = $data[$i]->getMessage();
      print_r($data[$i]);
      if ($data[$i]->getMessage()['text']) {
        if($isNewUser->getText() === '/start') {
          $this->commandStart($isNewUser, $data[$i]);
        } elseif ($isNewUser->getText() === '/pay') {
          $this->userPay();
        }
      }
    }
  }

  public function commandStart($check, $data) {

    if(!DbService::isUserDefined($check->getFrom()['username'])) {
      DbService::addUser($check->getFrom());
    } else {
      // echo 'You already exist';
      Telegram::sendMessage([
        'chat_id' => $data->getMessage()['chat']['id'], 
        'text' => 'You already exist'
      ]);
    }
  }

  public function saveMessage($allMessages) {
    // echo 'User send /pay';
    DbService::addResponseMessage($allMessages);
  }

  public function userPay() {
    DbService::addUserPay();
  }

  public function deleteMessage() {
    echo 'User send /delete';
  }

}