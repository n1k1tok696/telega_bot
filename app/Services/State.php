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
            $this->commandStart($userInfo, $userChatId);
          } elseif ($userMessage[0] === '/pay') {
            $this->commandPay($userInfo, $userMessage, $userChatId);
          } elseif ($userMessage[0] === '/delete') {
            $this->commandDelete($userMessage[1], $userChatId);
          } else {
            Telegram::sendMessage([
              'chat_id' => $userChatId, 
              'text' => 'I don\'t know this command'
            ]);
          }
        }
      }
    }
  }

  public function commandStart($userCheck, $chatId) {
    
    $returnedMessage = DbService::addUser($userCheck);

    Telegram::sendMessage([
      'chat_id' => $chatId, 
      'text' => $returnedMessage
    ]);
  }

  public function commandPay($user, $request, $chatId) {

    $returnedMessage = DbService::addUserPay($user['username'], $user['id'], $request);
    
    Telegram::sendMessage([
      'chat_id' => $chatId, 
      'text' => $returnedMessage
    ]);
  }

  public function commandDelete($id, $chatId) {
    
    $returnedMessage = DbService::deleteUserPay($id);

    Telegram::sendMessage([
      'chat_id' => $chatId, 
      'text' => $returnedMessage
    ]);
  }

}