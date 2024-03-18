<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 7;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'?bo_table='.$bo_table.'" class="ov_listall">전체목록</a>';

?>
<link rel="stylesheet" href="<?php echo $board_skin_url?>/admin.style.css">

<div class="local_ov01 local_ov">
	<?php echo $listall ?>
	<span class="btn_ov01"><span class="ov_txt">등록된 게시글수</span><span class="ov_num"> <?php echo number_format($total_count) ?>개</span></span>
</div>

<!-- 게시판 검색 시작 { -->
<form name="fsearch" method="get" class="local_sch01 local_sch">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="sca" value="<?php echo $sca ?>">
	<input type="hidden" name="sop" value="and">
	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>지점명</option>
	</select>
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="required frm_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
	<input type="submit" value="검색" class="btn_submit" />
</form>
<!-- } 게시판 검색 끝 -->

<!-- 게시판 카테고리 시작 { -->
<?php if ($is_category) { ?>
<ul id="bo_cate_ul" class="anchor">
		<?php echo $category_option ?>
</ul>
<?php } ?>
<!-- } 게시판 카테고리 끝 -->

<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">

	<div id='bo_list' class="tbl_head01 tbl_wrap">
			<table>
			<caption><?php echo $board['bo_subject'] ?> 목록</caption>
			<thead>
			<tr>
					<?php if ($is_checkbox) { ?>
					<th scope="col">
							<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
							<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
					</th>
					<?php } ?>
					<th scope="col">번호</th>
					<th scope="col">지역</th>
					<th scope="col">지점명</th>
					<th scope="col">주소</th>
					<th scope="col">대표자</th>
					<th scope="col">연락처</th>
					<th scope="col">영업시간</th>
			</tr>
			</thead>
			<tbody>
			<?php
			for ($i=0; $i<count($list); $i++) {

				$list[$i]['href'] = str_replace(G5_BBS_URL,G5_ADMIN_BBS_URL,$list[$i]['href']);
				$list[$i]['ca_name_href'] = str_replace(G5_BBS_URL,G5_ADMIN_BBS_URL,$list[$i]['ca_name_href']);

			?>
			<tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
					<?php if ($is_checkbox) { ?>
					<td class="td_chk">
							<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
					</td>
					<?php } ?>
					<td class="td_num2">
					<?php
					if ($list[$i]['is_notice']) // 공지사항
							echo '<strong class="notice_icon"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="sound_only">공지</span></strong>';
					else if ($wr_id == $list[$i]['wr_id'])
							echo "<span class=\"bo_current\">열람중</span>";
					else
							echo $list[$i]['num'];
					 ?>
					</td>
					<td>
						<?php
						if ($is_category && $list[$i]['ca_name']) {
						 ?>
						<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
						<?php } ?>
						<?php echo $list[$i]['wr_1'] ?>
					</td>
					<td class="td_subject" style="text-align:left;padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '5'; ?>px">
							<div class="bo_tit">

									<a href="<?php echo $list[$i]['href'] ?>">
											<?php echo $list[$i]['icon_reply'] ?>
											<?php
													if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
											 ?>
											<?php echo $list[$i]['subject'] ?>

									</a>
							</div>

					</td>
					<td><?php echo get_text($list[$i]['wr_3']) ?> <?php echo get_text($list[$i]['wr_4']) ?> <?php echo get_text($list[$i]['wr_5']) ?></td>
					<td><?php echo get_text($list[$i]['wr_7']) ?></td>
					<td>
						<div><?php echo hyphen_tel_number($list[$i]['wr_8']) ?></div>
						<div><?php echo hyphen_tel_number($list[$i]['wr_9']) ?></div>
					</td>
					<td><?php echo get_text($list[$i]['wr_10']) ?></td>
			</tr>
			<?php } ?>
			<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
			</tbody>
			</table>
	</div>

	<?php if ($list_href || $is_checkbox || $write_href) { ?>
	<div class="btn_fixed_top">
			<?php if ($list_href || $write_href) { ?>
				<?php if ($is_checkbox) { ?>
				<input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn_02 btn">
				<?php } ?>
			<?php } ?>
			<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_01 btn"><?php echo $board['bo_subject'];?> 등록</a><?php } ?>
	</div>
	<?php } ?>

</form>

</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>



<!-- 페이지 -->
<?php echo $write_pages;  ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
