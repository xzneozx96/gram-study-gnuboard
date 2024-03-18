<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$is_notice = false;
?>
<link rel="stylesheet" href="<?php echo $board_skin_url?>/style.css">
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
			<th scope="row"><label for="wr_subject">지역<?php echo $sound_only ?></label></th>
			<td>
				<?php $wr1Re = sql_query("select distinct(sido) as sido, idx from g5_address group by sido order by sido asc");?>
				<select name="wr_1" id="wr_1">
					<option value="">광역시/도 선택</option>
					<?php echo row_to_options($wr1Re,$write['wr_1'],true);?>
				</select>
				<?php $wr2Re = sql_query("select gugun, idx from g5_address where sido = '{$write['wr_1']}' order by gugun asc");?>
				<select name="wr_2" id="wr_2">
					<option value="">구/군 선택</option>
					<?php echo row_to_options($wr2Re,$write['wr_2'],true);?>
				</select>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_subject">매장명<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" placeholder="매장명" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_content">주소<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_content" value="<?php echo $write['wr_content'] ?>" id="wr_content" class="frm_input full_input" placeholder="주소" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_3">전화번호<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" class="frm_input full_input" placeholder="전화번호" style='width:89%'>
			</td>
	</tr>
	<tr>
			<th scope="row"><label for="wr_4">운영시간<?php echo $sound_only ?></label></th>
			<td>
				<input type="text" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4" class="frm_input full_input" placeholder="운영시간" style='width:89%'>
			</td>
	</tr>
	</table>

	<table class='mt10'>
	<colgroup>
			<col class="grid_4">
			<col>
	</colgroup>
	<tbody>
	<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
	<tr>
			<th scope="row"><label for="bf_file_<?php echo $i+1 ?>">매장사진 (640 X 420)<?php echo $sound_only ?></label></th>
			<td>
				<div class="file_wr write_div">
					<input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file ">
				</div>
				<?php if ($is_file_content) { ?>
				<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
				<?php } ?>

				<?php if($w == 'u' && $file[$i]['file']) { ?>
				<span class="file_del">
						<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
				</span>
				<?php } ?>
			</td>
	</tr>
	<?php } ?>
	</table>

</div>

<div class="btn_fixed_top">
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel btn_02 btn">취소</a>
		<input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submi btn btn_01">
</div>

</form>

<script>

$(function(){

	$(document).on('change','#wr_1',function(e){

		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "<?php echo $board_skin_url;?>/ajax.gugun.data.php",
			cache: false,
			async: false,
			data: {'wr_1':$(this).val()},
			success: function(data) {

				$('#wr_2').html(data);

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
