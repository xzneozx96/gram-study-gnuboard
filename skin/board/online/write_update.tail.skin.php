<?php
$wr_subject = get_text(stripslashes($wr_subject));

$tmp_html = 0;
if (strstr($html, 'html1'))
		$tmp_html = 1;
else if (strstr($html, 'html2'))
		$tmp_html = 2;

$wr_content = conv_content(conv_unescape_nl(stripslashes($wr_content)), $tmp_html);

$subject = $board['bo_subject'].'이(가) 등록되었습니다.';

$link_url = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;'.$qstr;

include_once(G5_LIB_PATH.'/mailer.lib.php');

ob_start();
include_once ($board_skin_path.'/formmail.php');
$content = ob_get_contents();
ob_end_clean();

$array_email = array();
$super_admin = get_admin('super');
$array_email[] = $super_admin['mb_email'];

// 중복된 메일 주소는 제거
$unique_email = array_unique($array_email);
$unique_email = array_values($unique_email);
for ($i=0; $i<count($unique_email); $i++) {
		mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1,$files_mail);
}

alert($board['bo_subject']."이(가) 등록되었습니다.\\n빠른 시간 내에 답변해 드리겠습니다.");
exit;
?>