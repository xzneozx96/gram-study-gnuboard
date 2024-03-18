
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

<div class="location_box">
    <h5 class="Title">
    	<span><img src="<?php echo $board_skin_url; ?>/img/mapicon.png" /></span><br />
        찾으실 지역을 선택하시면 해당 지역의 매장이 검색됩니다.
    </h5>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <input type="hidden" name="sfl" value="wr_subject||wr_1" />
    <div class="locBox_area">
        <div class="col-md-2 f_left formTit">지역검색</div>

        <div class="col-md-8 f_left">
            <?php $wr1Re = sql_query("select distinct(sido) as sido, idx from g5_address group by sido order by sido asc");?>
            <select name="si" id="si" title="광역시/도 선택" class="select col-md-6 f_left">
                <option value="">광역시/도 선택</option>
                <?php echo row_to_options($wr1Re,$si,true);?>
            </select>
            <?php $wr2Re = sql_query("select gugun, idx from g5_address where sido = '{$si}' order by gugun asc");?>
            <select name="gu" id="gu" class="select col-md-6 f_left">
                <option value="">구/군 선택</option>
                <?php echo row_to_options($wr2Re,$gu,true);?>
            </select>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-2 f_left"><input type="submit" value="검색" class="l_sumit"></div>
        <div class="clearfix"></div>
    </div>

    <div>
        <div class="col-md-2 f_left formTit">매장명 검색</div>
        <div class="col-md-8 f_left">
            <input type="text" name="stx" id="storeSearch" class="input" placeholder="매장명/지역을 입력해 주세요" value="<?php echo $stx;?>">
        </div>
        <div class="col-md-2 f_left"><input type="submit" value="검색" class="l_sumit"></div>
    </div>

		</form>

    <div class="clearfix"></div>

</div>


<div class="location_list"  style="overflow-x:auto;">
    <table id="table_scroll">
        <tr>
            <th>지역</th>
            <th>매장명</th>
            <th>주소</th>
            <th>전화번호</th>
            <th>상세정보</th>
        </tr>
        <?php for ($i=0; $i<count($list); $i++) :?>
            <tr>
                <td><?php echo $list[$i]['wr_1'];?></td>
                <td><?php echo $list[$i]['wr_subject'];?></td>
                <td><?php echo $list[$i]['wr_content'];?></td>
                <td><?php echo hyphen_tel_number($list[$i]['wr_3']);?></td>
                <td><a href="<?php echo $list[$i]['href'] ?>">상세정보</a></td>
            </tr>
        <?php endfor;?>
    </table>
</div>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<script>
$(function(){

	$(document).on('change','#si',function(e){

		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "<?php echo $board_skin_url;?>/ajax.gugun.data.php",
			cache: false,
			async: false,
			data: {'wr_1':$(this).val()},
			success: function(data) {

				$('#gu').html(data);

			}
		});

	});

});
</script>