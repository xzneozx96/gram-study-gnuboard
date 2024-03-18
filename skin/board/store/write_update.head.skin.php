<?php
$is_guest = false;
//$is_online = true; // /bbs/write_update.php 216열에  && !$is_online 추가
$_POST['wr_3'] = preg_replace('/[^0-9]*/s',"", $_POST['wr_3']);
?>