<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$thumb = get_list_thumbnail($board['bo_table'], $view['wr_id'], $board['bo_image_width'], '', false, true);
?>
<script src="<?php echo G5_JS_URL ?>/jquery.bxslider.js?ver=<?php echo G5_JS_VER; ?>"></script>

<div class="s22_con">
	<div class="col-md-12">
		<div class="img_rolling">
			<div id="productView">
				<?php
					// 파일 출력
					$v_img_count = count($view['file']);
					if($v_img_count) {
						for ($i=0; $i<=count($view['file']); $i++) {
							if ($view['file'][$i]['view']) {
								echo "<div>".$view['file'][$i]['view']."</div>";
							}
						}
					}
				?>
			</div>
			<div class="img_btn">
				<img src="/img/sub/left_btn.png" class="left">
				<img src="/img/sub/right_btn.png" class="right">
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="s22_info marT50">
		<div class="col-md-4 project marB20">
			<h3>프로젝트</h3>
			<p><?php echo get_text($view['wr_subject']); ?></p>
		</div>
		<div class="col-md-4 cast marB20">
			<h3>출연자</h3>
			<p><?php echo get_text($view['wr_1']); ?></p>
		</div>
		<div class="col-md-4 data marB20">
			<h3>기간</h3>
			<p><?php echo get_text($view['wr_2']); ?></p>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12 marT20">
			<h3>내용</h3>
			<p><?php echo get_view_thumbnail($view['content']); ?></p>
		</div>


	<div class="clearfix"></div>
	<div id="bo_v_top" class="marT50">
		<?php
		ob_start();
		?>
		<ul class="bo_v_com">
		   <li><a href="<?php echo $list_href ?>" class="btn_b01 btn"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></li>
		</ul>

		<?php if ($prev_href || $next_href) { ?>
		<ul class="bo_v_nb">
			<?php if ($prev_href) { ?><li class="btn_prv"><span class="nb_tit"><i class="fa fa-caret-up" aria-hidden="true"></i> 이전글</span><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a> <span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></li><?php } ?>
			<?php if ($next_href) { ?><li class="btn_next"><span class="nb_tit"><i class="fa fa-caret-down" aria-hidden="true"></i> 다음글</span><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a>  <span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></li><?php } ?>
		</ul>
		<?php } ?>
		<?php
		$link_buttons = ob_get_contents();
		ob_end_flush();
		 ?>
	</div>
	<!-- } 게시물 상단 버튼 끝 -->

	</div>

</div>

<script>
$(function(){

	var productView = $('#productView').bxSlider({
		mode: 'horizontal',
		pager: false,
		controls: false
	});

	$('.left').on('click',function(){
		productView.goToPrevSlide();
		return false;
	});

	$('.right').on('click',function(){
		productView.goToNextSlide();
		return false;
	});

});
</script>