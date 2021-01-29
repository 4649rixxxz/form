<?php


class Validation
{


  public static function make($target,$rules)
  {

    $errors = [];
    $lists = [
      'family_name' => '氏名(姓)',
      'name' => '氏名(名)',
      'email' => 'メールアドレス',
      'impression' => '感想',
      'next_buy' => '「次回も購入したいですか」'
    ];

    foreach($rules as $key => $array){

     
      //ルールのキーが対象の配列にあるか
      if(array_key_exists($key,$target)){
          //二重ループ
        foreach($array as $rule){
          //「required」
          if($rule == 'required'){
            if(empty($target[$key])){
              //エラーメッセージ
              $errors[$key] = $lists[$key]."は必須項目です";
              continue;
            }
          }

          //「max:」
          if(preg_match('/^max:[1-9][0-9]*/',$rule)){
            $rule = str_replace('max:','',$rule);
            //文字列から数値へ型変換
            $maxNumber = intval($rule);
            //文字数が最大文字数かどうか調べる
            if(mb_strlen($target[$key]) > $maxNumber){
              //オーバー文字
              $overNum = mb_strlen($target[$key]);
              //最大文字数との差
              $diff = $overNum - $maxNumber;
              //エラーメッセージ
              $errors[$key] = $lists[$key]."が最大文字数を".$diff.'文字超過しています';
              continue;
            }
          }

          //「email」
          if($rule == 'email'){
            //ルール
            $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
            //正規かどうか
            if(!preg_match($reg_str,$target[$key])){
              $errors[$key] = $lists[$key]."が不正な値です";
            }
          }
          
        }

      }
      
    }

    return $errors;
  }

  



}