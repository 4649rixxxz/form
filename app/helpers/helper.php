<?php


//リダイレクト
function redirect($page = '')
{
  header('location: '. URLROOT .'/'.$page);
}

//エラー時にセッションの値を取り出す
function getOldInput($key){

  $result = '';

  //該当するセッションキーがある場合に格納
  if(isset($_SESSION[$key])){
    $result = $_SESSION[$key];
  }

  echo $result;
}

//エラー時にセッションによるラジオボタンの取得
function getOldRadio($key,$value){

  $result = '';

  if(isset($_SESSION[$key]) && $_SESSION[$key] == $value){
    $result = "checked";
  }

  echo $result;
}






