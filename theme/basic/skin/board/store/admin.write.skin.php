<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$is_notice = false;
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="<?php echo $board_skin_url?>/admin.style.css">
<!-- 게시물 작성/수정 시작 { -->
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<?php
$option = '';
$option_hidden = '';
if ($is_notice || $is_html || $is_secret || $is_mail) {
		$option = '';
		if ($is_notice) {
				$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">상단표기</label>';
		}

		if ($is_html) {
				if ($is_dhtml_editor) {
						$option_hidden .= '<input type="hidden" value="html1" name="html">';
				} else {
						$option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
				}
		}

		if ($is_secret) {
				if ($is_admin || $is_secret==1) {
						$option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
				} else {
						$option_hidden .= '<input type="hidden" name="secret" value="secret">';
				}
		}

		if ($is_mail) {
				$option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
		}
}

echo $option_hidden;
?>
<div class="tbl_frm01 tbl_wrap">

	<table>
	<colgroup>
			<col class="grid_4">
			<col>
	</colgroup>
	<tbody>
	<tr>
			<th scope="row"><label for="ca_name">지역<?php echo $sound_only ?></label></th>
			<td>
				<?php $wr1Re = sql_query("select distinct(sido) as sido, idx from BRI_address group by sido order by sido asc");?>
				<select name="ca_name" id="ca_name">
					<option value="">광역시/도 선택</option>
					<?php echo row_to_options($wr1Re,$write['ca_name'],true);?>
				</select>
				<?php $wr2Re = sql_query("select gugun, idx from BRI_address where sido = '{$write['ca_name']}' order by gugun asc");?>
				<select name="wr_1" id="wr_1">
					<option value="">구/군 선택</option>
					<?php echo row_to_options($wr2Re,$write['wr_1'],true);?>
				</select>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_subject">지점명<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" placeholder="지점명" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row">주소</th>
			<td colspan="3" class="td_addr_line">
					<label for="wr_2" class="sound_only">우편번호</label>
					<input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" id="wr_2" class="frm_input readonly" size="5" maxlength="6">
					<button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'wr_2', 'wr_3', 'wr_4', 'wr_5', 'wr_6');">주소 검색</button><br>
					<input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" class="frm_input readonly" size="60">
					<label for="wr_3">기본주소</label><br>
					<input type="text" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4" class="frm_input" size="60">
					<label for="wr_4">상세주소</label>
					<br>
					<input type="text" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" class="frm_input" size="60">
					<label for="wr_5">참고항목</label>
					<input type="hidden" name="wr_6" value="<?php echo $write['wr_6']; ?>"><br>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_7">대표자<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_7" value="<?php echo $write['wr_7'] ?>" id="wr_7" class="frm_input full_input" placeholder="대표자" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_8">휴대폰<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_8" value="<?php echo $write['wr_8'] ?>" id="wr_8" class="frm_input full_input" placeholder="휴대폰" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_9">전화번호<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_9" value="<?php echo $write['wr_9'] ?>" id="wr_9" class="frm_input full_input" placeholder="전화번호" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_10">영업시간<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_10" value="<?php echo $write['wr_10'] ?>" id="wr_10" class="frm_input full_input" placeholder="영업시간" style='width:89%'>
			</td>
	</tr>
	</table>

	<div class="write_div">
			<label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
			<div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
					<?php if($write_min || $write_max) { ?>
					<!-- 최소/최대 글자 수 사용 시 -->
					<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
					<?php } ?>
					<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
					<?php if($write_min || $write_max) { ?>
					<!-- 최소/최대 글자 수 사용 시 -->
					<div id="char_count_wrap"><span id="char_count"></span>글자</div>
					<?php } ?>
			</div>

	</div>

</div>

<div class="btn_fixed_top">
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel btn_02 btn">취소</a>
		<input type="submit" value="등록완료" id="btn_submit" accesskey="s" class="btn_submi btn btn_01">
</div>

</form>

<script>

$(function(){

	$(document).on('change','#ca_name',function(e){

		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "<?php echo $board_skin_url;?>/ajax.gugun.data.php",
			cache: false,
			async: false,
			data: {'ca_name':$(this).val()},
			success: function(data) {

				$('#wr_1').html(data);

			}
		});

	});

});

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
		$("#wr_content").on("keyup", function() {
				check_byte("wr_content", "char_count");
		});
});

<?php } ?>
function html_auto_br(obj)
{
		if (obj.checked) {
				result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
				if (result)
						obj.value = "html2";
				else
						obj.value = "html1";
		}
		else
				obj.value = "";
}

function fwrite_submit(f)
{
		<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

		var subject = "";
		var content = "";
		$.ajax({
				url: g5_bbs_url+"/ajax.filter.php",
				type: "POST",
				data: {
						"subject": f.wr_subject.value,
						"content": f.wr_content.value
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
						subject = data.subject;
						content = data.content;
				}
		});

		if (subject) {
				alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
				f.wr_subject.focus();
				return false;
		}

		if (content) {
				alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
				if (typeof(ed_wr_content) != "undefined")
						ed_wr_content.returnFalse();
				else
						f.wr_content.focus();
				return false;
		}

		if (document.getElementById("char_count")) {
				if (char_min > 0 || char_max > 0) {
						var cnt = parseInt(check_byte("wr_content", "char_count"));
						if (char_min > 0 && char_min > cnt) {
								alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
								return false;
						}
						else if (char_max > 0 && char_max < cnt) {
								alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
								return false;
						}
				}
		}

		<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

		document.getElementById("btn_submit").disabled = "disabled";

		return true;
}
</script>
