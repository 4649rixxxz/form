<?php

class Controller
{
  public function model($model)
  {
    require_once '../app/Models/' .$model. '.php';

    //インスタンス化
    return new $model();
  }

  // Load view
  public function view($view,$data = [])
  {
    if(file_exists('../app/views/'. $view . '.php')){
      require_once '../app/views/'. $view . '.php';
    }else{
      die('view does not exist');
    }
  }
}


?>