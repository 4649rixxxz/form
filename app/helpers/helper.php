<?php



//　リダイレクト
function redirect($page = '')
{
  header('location: '. URLROOT .'/'.$page);
}




