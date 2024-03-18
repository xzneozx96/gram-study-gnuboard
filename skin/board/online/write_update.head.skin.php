<?php
$is_guest = false;
$is_online = true; // /bbs/write_update.php 216열에  && !$is_online 추가

$_POST['wr_email'] = $_POST['wr_email1'].'@'.$_POST['wr_email2'];
$_POST['wr_subject'] = $_POST['wr_name'].'님 문의입니다.';
?>