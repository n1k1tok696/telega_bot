<?php 

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\TelegramUser;
use App\Models\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

use DbService;

class State {

  private $offset = 0;
  // private $count;
  // private static $offset = 0;

  // function __construct()
  // {
  //   $some = DbService::getLastMessageId();
  //   if (DbService::getLastMessageId()) {
  //     Self::$offset = DbService::getLastMessageId();
  //   }
  // }

  public function getFromTelegram() {

    if (DbService::getLastMessageId()) {
      $this->offset = DbService::getLastMessageId();
    }

    // $offsetIndex = DbService::getLastMessageId();

    // $params = [ 'offset' => $offsetIndex];

    // dd($this->count);
    $params = [ 'offset' => $this->offset];
    $data = Telegram::getUpdates($params); 
    // dd($data);

    for ($i=0; $i < count($data); $i++) {
      if (!isset($data[$i]['edited_message'])) {
        DbService::saveMessageToLog($data[$i]);

        $telegramMessage = $data[$i]->getMessage();
        
        $text = $telegramMessage['text'];
        $userInfo = $telegramMessage['from'];
        $userChatId = $telegramMessage['chat']['id'];
        // $username = $userInfo['username'];
        // $userId = $userInfo['id'];

        $userMessage = preg_split('/\s+/', $text);
        $checkCommand = preg_match('/^\//', $userMessage[0]);

        if ($text && $checkCommand) {
          if($userMessage[0] === '/start') {
            $this->commandStart($userInfo, $telegramMessage);
          } elseif ($userMessage[0] === '/pay') {
            $this->commandPay($userInfo, $userMessage, $userChatId);
          } elseif ($userMessage[0] === '/delete') {
            $this->deleteMessage($receiptId);
          }
        }
      }
    }
  }

  public function commandStart($userCheck, $data) {
    $chatId = $data['chat']['id'];
    $isUserExist = DbService::isUserDefined($userCheck['username']);
    if(!$isUserExist) {
      DbService::addUser($userCheck);
    } else {
      Telegram::sendMessage([
        'chat_id' => $chatId, 
        'text' => 'You already exist'
      ]);
    }
  }

  public function commandPay($user, $request, $chatId) {
    
    $isUserExist = DbService::isUserDefined($user['username']);

    if ($isUserExist && count($request) >= 5) {
      DbService::addUserPay($user['id'], $request);
    } else {
      Telegram::sendMessage([
        'chat_id' => $chatId, 
        'text' => $isUserExist ? 'Wrong pay command' : 'I don\'t know you'
      ]);
    }
  }

  public function deleteMessage() {
    echo 'User send /delete';
  }

}