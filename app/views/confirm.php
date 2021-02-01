<?php require APPROOT . '/views/layouts/header.php'; ?>
<h1>確認画面</h1>
<h3 id="confirm_message">以下の情報で送信してよろしいですか</h3>
<form action="<?php echo URLROOT;?>/store" method="POST">
  <!-- 姓、名の入力フォーム -->
  <div class="form_box form_flex">
    <div class="item_head">
      <div>
        <p>氏名</p>
      </div>
    </div>
    <div class="item_input form_flex">
      <div>
        <h4>姓</h4>
        <p><?php echo $_SESSION["family_name"];?></p>
      </div>
      <div class="left">
        <h4>名</h4>
        <p><?php echo $_SESSION["name"];?></p>
      </div>
    </div>
  </div>
  <!-- メールアドレス -->
  <div class="form_box form_flex">
    <div class="item_head">
      <div>
        <p>メールアドレス</p>
      </div>
    </div>
    <div class="item_input item_center">
      <p><?php echo $_SESSION["email"];?></p>
    </div>
  </div>
  <!-- 感想 -->
  <div class="form_box form_flex">
    <div class="item_head">
      <div>
        <p>感想</p>
      </div>
    </div>
    <div class="item_input">
      <div><?php echo $_SESSION["impression"];?></div>
    </div>
  </div>
  <!-- 次回も購入したいですか -->
  <div class="form_box form_flex">
    <div class="item_head">
      <div>
        <p>次回も購入したいですか</p>
      </div>
    </div>
    <div class="item_input">
      <div>
        <p><?php echo $_SESSION["next_buy"];?></p>
      </div>
    </div>
  </div>
  <div class="form_flex" id="two_choice">
    <button type="button" onclick="history.back()" id="return">
      戻る
    </button>
    <div id="submit">
      <input type="submit" value="送信する">
    </div>
  </div>
</form>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

