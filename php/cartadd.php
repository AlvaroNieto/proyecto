<?php
session_start();
if(!isset($_GET['remove'])) {
  $id=$_GET['id'];
  if(!isset($_SESSION['cartadd'])) {
    $_SESSION['cartadd'] = array();
  }
  array_push($_SESSION['cartadd'],"$id");
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  $id=$_GET['remove'];
  if(($key = array_search($id, $_SESSION['cartadd'])) !== false) {
    unset($_SESSION['cartadd'][$key]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
 ?>
