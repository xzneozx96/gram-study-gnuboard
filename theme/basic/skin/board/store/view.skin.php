<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_kakao_js_apikey'];?>&libraries=services"></script>

<!--뷰페이지 퍼블-->
<div class="branches_view">
	<h3 class="name"><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></h3>
    <div id='map' class="map_area"></div>
		<script>
		function get_map(){

			var mapContainer = document.getElementById('map'), // 지도를 표시할 div
					mapOption = {
							center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
							level: 3 // 지도의 확대 레벨
					};

			var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

			// 주소-좌표 변환 객체를 생성합니다
			var geocoder = new kakao.maps.services.Geocoder();

			// 주소로 좌표를 검색합니다
			geocoder.addressSearch('<?php echo get_text($view['wr_3']) ?> <?php echo get_text($view['wr_4']) ?>', function(result, status) {

					// 정상적으로 검색이 완료됐으면
					 if (status === kakao.maps.services.Status.OK) {

							var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

							// 결과값으로 받은 위치를 마커로 표시합니다
							var marker = new kakao.maps.Marker({
									map: map,
									position: coords
							});

							// 인포윈도우로 장소에 대한 설명을 표시합니다
							var infowindow = new kakao.maps.InfoWindow({
									content: '<div style="width:150px;text-align:center;padding:6px 0;"><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></div>'
							});
							infowindow.open(map, marker);

							// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
							map.setCenter(coords);
					}
			});

		}
		get_map();

		$(window).resize(function(){
			get_map();
		});
		</script>

    <h4 class="info_tlt">매장안내</h4>
    <div class="info">
        <div>
        	<dl>
            	<dt>지점명</dt>
                <dd><?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></dd>
            </dl>
            <dl>
            	<dt>대표</dt>
                <dd><?php echo get_text($view['wr_7']) ?></dd>
            </dl>
            <dl>
            	<dt>영업시간</dt>
                <dd><?php echo get_text($view['wr_10']) ?></dd>
            </dl>
        </div>
        <div class="scd_cts">
        	<dl>
            	<dt>주소</dt>
                <dd><?php echo get_text($view['wr_3']) ?> <?php echo get_text($view['wr_4']) ?> <?php echo get_text($view['wr_5']) ?></dd>
            </dl>
            <dl>
            	<dt>휴대폰</dt>
                <dd><?php echo hyphen_tel_number($view['wr_8']) ?></dd>
            </dl>
            <dl>
            	<dt>전화번호</dt>
                <dd><?php echo hyphen_tel_number($view['wr_9']) ?></dd>
            </dl>
        </div>
    </div>

    <!--첨부파일-->
    <div class="feature"><?php echo get_view_thumbnail($view['content']); ?></div>
	
    <div class="btn_area">
    <a href="<?php echo ($search_href)? $search_href : $list_href; ?>" class="list_btn_list">List<i class="xi-apps"></i></a>
	<div class="btn_area_rcon" ><?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="list_btn">수정<!--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--></a><?php } ?>
    <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="list_btn" onclick="del(this.href); return false;">삭제<!--<i class="fa fa-trash-o" aria-hidden="true"></i>--></a><?php } ?>
    </div>
    </div>

</div>

<!--//뷰페이지 퍼블-->

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>
<!-- } 게시글 읽기 끝 -->