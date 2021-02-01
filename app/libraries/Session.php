<?php


class Session
{
  public static function setValue($array)
  {
    foreach($array as $key => $value){
      $_SESSION[$key] = $value;
    }
    
  }

  public static function destroy()
  {
    $_SESSION = [];
    session_destroy();
  }
}