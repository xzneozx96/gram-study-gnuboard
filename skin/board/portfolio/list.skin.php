<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="s21_con">
	<?php for ($i=0; $i<count($list); $i++) :
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 850, 540, false, true);
		$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="100%">';
	?>
		<div class="col-md-4 marB20">
			<a href="<?php echo $list[$i]['href'] ?>">
				<div class="img"><?php echo $img_content;?></div>
				<div class="stit"><?php echo $list[$i]['ca_name'] ?></div>
				<div class="tit"><?php echo $list[$i]['subject'] ?></div>
			</a>
		</div>
	<?php endfor;?>
</div>
<!-- 페이지 -->
<?php echo $write_pages;  ?>