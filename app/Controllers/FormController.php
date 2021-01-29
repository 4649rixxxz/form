<?php

class FormController extends Controller
{
  private $post;
  private $errors;
  private $model;

  public function __construct()
  {
    $this->model = $this->model('Form');
  }

  public function index()
  {
    // 気に食わない
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == URLROOT.'/'){
      session_start();
      // echo "テスト";
    }

    $this->view('enter');
  }

  public function confirm()
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $this->post = $_POST;

      //改行処理、特殊文字の処理
      foreach($this->post as $key => $value){
        //空でなければ
        if(!empty($value)){

          $search = ["\r\n", "\r", "\n"];
          $replace = [PHP_EOL, PHP_EOL, PHP_EOL];
          $value = str_replace($search, $replace,$value);

          $value = htmlspecialchars($value,ENT_QUOTES,"UTF-8");

          $this->post[$key] = $value;
        }
      }

    
      // var_dump($this->post);
      //バリデーションルール
      $rules = [
        'family_name' => ['required','max:10'],
        'name' => ['required','max:10'],
        'email' => ['required','email'],
        'impression' => ['required','max:10'],
        'next_buy' => ['required'],
      ];

      

       //バリデーション
      $errors = Validation::make($this->post,$rules);

      //セッション開始
      session_start();
      session_regenerate_id();

      //セッションタイムアウト
      $_SESSION['timeout'] = time();

      //ノーエラー
      if(count($errors) == 0){
        
        //確認画面へ
        $this->view('confirm',$this->post);
        
      }else{
        // エラー内容の格納
        $this->post['errors'] = $errors;
        // setOldInput
        Session::setOldInput($this->post);
        // 入力画面へリダイレクト
        redirect();
        exit();
        
      }

    }
    // Post送信以外
    else{
      // 入力画面へリダイレクト
      redirect();
    }
  }


  public function store()
  {
    session_start();
    // セッションタイムアウト時の更新時のリダイレクト
    if(empty($_SESSION['timeout'])){
      redirect();
      exit();
    }
    // 5分
    if(isset($_SESSION['timeout']) && $_SESSION['timeout'] + 300 < time()){
      $_SESSION = [];
      Session::destroy();
      echo "セッションタイムアウト<br>";
      echo "<a href='".URLROOT."'>トップページに戻る</a>";
      exit();
    }else{

      $this->post = $_POST;
      // die('成功');
      //セッション放棄
      $_SESSION = [];
      Session::destroy();
      var_dump($this->post);
      //DB処理
      if($this->model->insert($this->post)){
        //完了画面へリダイレクト
        redirect('completed');
      }else{
        die('しばらく時間を空けてから再度お試しください');
      }

    }

  }


  public function completed()
  {
    $url = URLROOT.'/confirm';

    if($_SERVER['HTTP_REFERER'] == $url){
      $this->view('completed');
    }else{
      redirect();
    }
  }


}

?>