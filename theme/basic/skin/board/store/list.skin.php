<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;
//$is_checkbox = $write_href = false;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script src="'.$board_skin_url.'/d3.min.js"></script>', 0);
?>
<!-- <h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>==?

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
	<div class="cate_map_wrap">
    	<h3 class="branches_tlt">Gram Study Cafe Franchise Map</h3>
		  <?php include_once('branches.map.php');?>
        <div class="cate_search_wrap">
        <!-- 게시판 검색 시작 { -->
        <fieldset id="bo_sch">
            <legend>게시물 검색</legend>

            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <option value="">전체</option>
                <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>지점명</option>
                <option value="wr_3"<?php echo get_selected($sfl, 'wr_3'); ?>>주소</option>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
            <input type="submit" value="검색" id="btn_submit" class="btn_submit">
            </form>
        </fieldset>
        <!-- } 게시판 검색 끝 -->
        </div>

        <div class="cate_search_tablet_wrap">
        	<h3>Gram Study Cafe <span class="mobile_block">Franchise Map</span></h3>
        	<fieldset>
								<form name="fsearch" method="get">
								<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
								<input type="hidden" name="sop" value="and">
							  <input type="hidden" name="sfl" value="wr_subject">
                   <div class="area_search">
                    	<span>
												<?php $wr1Re = sql_query("select distinct(sido) as sido, idx from BRI_address group by sido order by sido asc");?>
												<select name="sca" id="sca">
													<option value="">광역시/도 선택</option>
													<?php echo row_to_options($wr1Re,$sca,true);?>
												</select>
											</span>
                                            <!---------- 구/군 선택 ------------>
                                            <!--
											<span>
												<//?php $wr2Re = sql_query("select gugun, idx from BRI_address where sido = '{$sca}' order by gugun asc");?>
												<select name="wr_1" id="wr_1">
													<option value="">구/군 선택</option>
													<//?php echo row_to_options($wr2Re,$wr_1,true);?>
												</select>
											</span>
											-->
                    </div>
                    <div class="name_search">
											<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" class="frm_input"  placeholder="지점명검색" />
                    	<input type="submit" value="검색" id="btn_submit" class="btn_submit">
                    </div>
                </form>
            </fieldset>
        </div>

	</div> <!-- cate_map_wrap 끝-->



    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>총 <?php echo number_format($total_count) ?>건</span>
            <!--<?//php echo $page ?> 페이지-->
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

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

    <div class="tbl_head01 tbl_wrap">
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
            <th scope="col" class="td_num">번호</th>
            <th scope="col">지점명</th>
            <th scope="col">주소</th>
            <th scope="col" class="tel_num">연락처</th>
            <th scope="col" class="link_btn"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_num"><?php echo $list[$i]['num'];?></td>
            <td class="td_date"><?php echo $list[$i]['wr_subject'] ?></td>
            <td class="td_subject"><?php echo get_text($list[$i]['wr_3']) ?> <?php echo get_text($list[$i]['wr_4']) ?></td>
            <td class="tel_num"><?php echo hyphen_tel_number($list[$i]['wr_9']) ?></td>
            <td class="link_btn"><a href="<?php echo $list[$i]['href'] ?>">상세보기</a></td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
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
