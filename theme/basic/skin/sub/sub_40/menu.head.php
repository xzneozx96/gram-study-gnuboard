<link rel="stylesheet" href="/theme/basic/skin/sub/sub_40/style.css">

<script>
function fwrite_submit(f)
{
	if (f.w.value == '') {
		 if (!f.agree1.checked) {
		 alert('개인정보 수집 및 이용에 대한 동의하지 않으면 등록하실 수 없습니다.');
		 f.agree1.focus();
		 return false;
		 }
	}
		return true;
}

$(function(){
	$('[name=wr_email3]').on('change',function(){
		$('[name=wr_email2]').val($(this).val());
		if($(this).val() == ''){
			$('[name=wr_email2]').focus();
			$('[name=wr_email2]').attr('readonly',false);
		}
		else{
			$('[name=wr_email2]').attr('readonly',true);
		}//end else

	});
});
</script>

<script>
	$(function(){
		$(window).scroll(function(){  //스크롤하면 아래 코드 실행
			   var num = $(this).scrollTop();  // 스크롤값
			   if( num > 1500 ){  // 스크롤을 36이상 했을 때
				  $('.clip_wrap').addClass('clip');
			   }
		  });
		});
</script>

<script>
	AOS.init({
		duration: 1200,
	});
</script>