<?php require APPROOT . '/views/layouts/header.php'; ?>
<h1>感想フォーム</h1>
<form action="<?php echo URLROOT;?>/confirm" method="POST">
<!-- 姓、名の入力フォーム -->
<?php if(isset($_SESSION['errors'])) :?>
  <div id="errors">
    <ul>
    <?php foreach($_SESSION['errors'] as $value): ?>
      <li><?php echo $value; ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<div class="form_box form_flex">
  <div class="item_head">
    <div>
      <div class="left">
        <span class="required">必須</span>
      </div>
      <p>氏名</p>
    </div>
  </div>
  <div class="item_input form_flex">
    <div>
      <h4>姓</h4>
      <input type="text" name="family_name" 
        value="<?php getOldInput("family_name") ?>" class="required_form">
    </div>
    <div class="left">
      <h4>名</h4>
      <input type="text" name="name" value="<?php getOldInput("name") ?>" class="required_form">
    </div>
  </div>
</div>
<!-- メールアドレス -->
<div class="form_box form_flex">
  <div class="item_head">
    <div>
      <div class="left">
        <span class="required">必須</span>
      </div>
      <p>メールアドレス</p>
    </div>
  </div>
  <div class="item_input item_center">
    <input type="email" name="email" value="<?php getOldInput("email")?>" class="required_form">
  </div>
</div>
<!-- 感想 -->
<div class="form_box form_flex">
  <div class="item_head">
    <div>
      <div class="left">
        <span class="required">必須</span>
      </div>
      <p>感想</p>
    </div>
  </div>
  <div class="item_input">
    <p class="attention">最大文字数300文字 現在の文字数<span id="impression_num">0</span></p>
    <textarea name="impression" maxlength="300" id="impression" class="required_form"><?php getOldInput("impression")?></textarea>
  </div>
</div>
<!-- 次回も購入したいですか -->
<div class="form_box form_flex">
  <div class="item_head">
    <div>
      <div class="left">
        <span class="required">必須</span>
      </div>
      <p>次回も購入したいですか</p>
    </div>
  </div>
  <div class="item_input">
    <div>
      <input type="radio" name="next_buy" value="ぜひ買いたい" class="required_radio" id="definitely" <?php getOldRadio("next_buy","ぜひ買いたい")?>>
      <label for="definitely">ぜひ買いたい</label>
    </div>
    <div>
      <input type="radio" name="next_buy" value="機会があれば買いたい" class="required_radio" id="opportunity" <?php getOldRadio("next_buy","機会があれば買いたい")?>>
      <label for="opportunity">機会があれば買いたい</label>
    </div>
    <div>
      <input type="radio" name="next_buy" value="あまり買おうと思わない" class="required_radio" id="not_really" <?php getOldRadio("next_buy","あまり買おうと思わない")?>>
      <label for="not_really">あまり買おうと思わない</label>
    </div>
    <div>
      <input type="radio" name="next_buy" value="もう買わない" class="required_radio" id="never" <?php getOldRadio("next_buy","もう買わない")?>>
      <label for="never">もう買わない</label>
    </div>
    <div style="display:none;">
      <input type="radio" name="next_buy" value="" <?php if(!isset($_SESSION['next_buy'])) {echo "checked";}?>>
    </div>
  </div>
</div>
<div id="submit">
  <input type="submit" value="確認画面へ">
</div>
</form>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
