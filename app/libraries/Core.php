<?php


class Core
{
  protected $currentController = 'FormController';
  protected $currentMethod = 'index';
  protected $params = [];


  public function __construct()
  {

    $url = $this->getUrl();

   
    require_once '../app/Controllers/'.$this->currentController.'.php';

    //インスタンス化
    $this->currentController = new $this->currentController();

    //$url[1]があるかどうか
    if(isset($url[0])){
      //メソッドがあるかどうか
      if(method_exists($this->currentController,$url[0])){
        $this->currentMethod = $url[0];

        // 値のリセット
        unset($url[0]);
      }
    }

    //パラメータの取得
    $this->params = $url ? array_values($url) : [];

    //パラメータを用いてコールバック
    call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
  }


  public function getUrl()
  {
    if(isset($_GET['url'])){
      //最後の「/」削除
      $url = rtrim($_GET['url'],'/');
      //サニタイズ
      $url = filter_var($url,FILTER_SANITIZE_URL);
      //分割
      $url = explode('/',$url);

      return $url;
    }

  }
}