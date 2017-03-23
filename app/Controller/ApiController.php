<?php

/**
 * Created by PhpStorm.
 * User: satoudai
 * Date: 2016/10/22
 * Time: 12:14
 */
class ApiController extends AppController {
    # フォームヘルパー
    public $helpers = array('Html', 'Form');
    #Cookieの使用
    var $components = array('Cookie');
    # 共通スクリプト
    public function beforeFilter() {
        # ページタイトル設定
        parent::beforeFilter();
        $this->autoRender = FALSE;
        $this->layout = 'sample';
        # 使用モデル
        $this->loadModel("LineWebhook");
        # 必要情報定義
        define('CHANNEL_SECRET', 'fa759adb6a9d5dd15c876b6f5b632817');
        define('CHANNEL_ACCESS_TOKEN', 'TnEzvi3NGKZllYlBkdqYgqbbdOxCyfqeP7IK+gdvAKW2ZJnypCimBORaYRLII05JUmnd2NKHCaY4E+YBMmbrFuY6hjpvan/NCtST18TdwWO5p0POimUObvVB/b53EIuT843Tn+1FwrTEm+c6Ab2DWwdB04t89/1O/w1cDnyilFU=');
    }

    public function callback(){
        if($this->request->is('post')){
            $obj = json_decode(file_get_contents('php://input'));
            $event = $obj->{"events"}[0];
            $replyToken = $this->insertObjectDB($event);
            if($replyToken!=null){
                $text = "Salut!";
                $original_image_url = "https://marksato.sakura.ne.jp/sushikaz_4.0/img/sushikaz2.jpg";
                $response_format_text = $this->replyImage($original_image_url, $original_image_url);
                $this->sendPost($replyToken, $response_format_text);
            }
        }
    }

    public function insertObjectDB($event){
        // timestamp format change
        $timestamp = date('Y-m-d H:i:s', floor($event->{"timestamp"}/1000));
        $data = array('LineWebhook' => array(
            'replyToken' => $event->{"replyToken"},
            'type' => $event->{"type"},
            'timestamp' => $timestamp,
            'user_type' => $event->{"source"}->{"type"},
            'user_id' => $event->{"source"}->{"userId"},
            'message_id' => $event->{"message"}->{"id"},
            'message_type' => $event->{"message"}->{"type"},
            'message_text' => $event->{"message"}->{"text"},
        ));
        if($this->LineWebhook->save($data)){ return $event->{"replyToken"}; } else{ return null; }
    }

    public function replyText($text){
        $response_format_text = [
            "type" => "text",
            "text" => $text
        ];
        return $response_format_text;
    }

    public function replyImage($original_image_url, $preview_image_url){
        $response_format_text = [
            "type" => "image",
            "originalContentUrl" => $original_image_url,
            "previewImageUrl" => $preview_image_url
        ];
        return $response_format_text;
    }

    public function sendPost($replyToken, $response_format_text){
        $post_data = [
            "replyToken" => $replyToken,
            "messages" => [$response_format_text]
        ];
        $ch = curl_init("https://api.line.me/v2/bot/message/reply");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charser=UTF-8',
            'Authorization: Bearer ' . CHANNEL_ACCESS_TOKEN
        ));
        $result = curl_exec($ch);curl_close($ch);
        return $result;
    }

}