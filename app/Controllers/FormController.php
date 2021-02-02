<?php

class FormController extends Controller
{
  private $post;
  private $model;

  public function __construct()
  {
    $this->model = $this->model('Form');
  }

  public function index()
  {
    // エラー時に「確認画面」から戻る際にセッション開始
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == URLROOT.'/'){
      session_start();
    }

    $this->view('enter');
  }

  public function confirm()
  {
    // Post送信時
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $this->post = $_POST;

      //各値の処理
      foreach($this->post as $key => $value){
        //空でなければ
        if(!empty($value)){

          //改行処理
          $search = ["\r\n", "\r", "\n"];
          $value = str_replace($search,PHP_EOL,$value);
          //特殊文字の処理
          $value = htmlspecialchars($value,ENT_QUOTES,"UTF-8");

          $this->post[$key] = $value;
        }
      }

    
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

      //ワンタイムトークンの生成
      $_SESSION['token'] = uniqid(bin2hex(random_bytes(1)));
      //セッションタイムアウト
      $_SESSION['timeout'] = time();
      //セッションに格納
      Session::setValue($this->post);

      //ノーエラー
      if(count($errors) == 0){
        
        //確認画面へ
        $this->view('confirm');
        
      }else{
        // エラー内容の格納
        $_SESSION['errors'] = $errors;
        // 入力画面へリダイレクト
        redirect();
        exit();
        
      }

    }
    else{
      // Post送信以外
      // 入力画面へリダイレクト
      redirect();
    }
  }


  public function store()
  {
    session_start();
    // 不正なリクエスト、セッションタイムアウト時の更新時の入力画面へのリダイレクト
    if(empty($_SESSION['token']) || empty($_SESSION['timeout'])){
      redirect();
      exit();
    }
    //csrf対策
    if(!isset($_POST['token']) || (isset($_POST['token']) && $_POST['token'] !== $_SESSION['token'])){
      Session::destroy();
      echo "不正なリクエストです<br>";
      echo "<a href='".URLROOT."'>トップページに戻る</a>";
      exit();
    }
    // セッションタイムアウトの場合にセッションタイムであることを表示
    if(isset($_SESSION['timeout']) && $_SESSION['timeout'] + 300 < time()){
      Session::destroy();
      echo "セッションタイムアウト<br>";
      echo "<a href='".URLROOT."'>トップページに戻る</a>";
      exit();
    }

    /* 
      以下、正常時の処理
    */
    
    //ワンタイムトークン、セッションタイムアウト削除し、フォームの値を取り出す
    unset($_SESSION['token']);
    unset($_SESSION['timeout']);
    $this->post = $_SESSION;
    // セッション放棄
    Session::destroy();
    // DB処理
    if($this->model->insert($this->post)){
      //完了画面へリダイレクト
      redirect('completed');
    }else{
      die('しばらく時間を空けてから再度お試しください');
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