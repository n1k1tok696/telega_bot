<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\TelegramUser;

use DbService;

class ControllerGetdata extends Controller
{
  public function get() {
    $url = 'https://api.telegram.org/bot937789878:AAGbnhI-mBGucTLbNXcdzXDc6bjhRk1Vk2A/getUpdates';
      
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL, $url);

    $res = curl_exec($ch);
    $data = json_decode($res)->result;

    curl_close($ch);

    // $client = new \GuzzleHttp\Client( ['base_uri' => 'https://api.telegram.org/bot' . \Telegram::getAccessTocken() . '/'] );
    // $result = $client->request('', [], 'GET');
    // $result->getBody();

    // dd($result->getBody());
    echo '<pre>';
    for ($i=0; $i < count($data); $i++) {

      print_r($data[$i]);

      $isNewUser = $data[$i]->message;
      
      if (isset($data[$i]->message->text)) {
        if($isNewUser->text === '/start') {
          if(!DbService::isUserDefined($isNewUser->from->username)) {
            DbService::addUser($isNewUser->from);
          } else {
            echo 'You already exist';
          }
  
        }
      }
    }
  }
}
