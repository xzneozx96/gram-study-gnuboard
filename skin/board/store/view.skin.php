<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="container page_wrap">
	<h4 class="gt_cBl">매장정보</h4>
    <div class="py-2">
        <div style="overflow-x:auto;">
            <table class="table .table_scroll ">
                <thead>
                    <tr>
                        <th>매장명</th>
                        <th>지역</th>
                        <th>주소</th>
                        <th>운영시간</th>
                        <th>연락처</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $view['wr_subject'];?></td>
                        <td><?php echo get_text($view['wr_1']);?></td>
                        <td><?php echo $view['wr_content'];?></td>
                        <td><?php echo get_text($view['wr_4']);?></td>
                        <td><?php echo hyphen_tel_number($view['wr_3']);?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <h4 class="gt_cBl mt-3">찾아오시는 길</h4>
    <div class="map py-3">
			<div id="map" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%;height:500px;"></div>
		</div>

    <h4 class="gt_cBl mt-3">매장사진</h4>
    <div class="row py-3">
        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            for ($i=0; $i<=count($view['file']); $i++) {
                echo '<div class="col-md-3 mb-5">'.get_file_thumbnail($view['file'][$i],255).'</div>';
            }
        }
         ?>
<!--
        <div class="col-md-3 mb-5">
            <a href="#;">
                <img src="/img/inter_img2.jpg"  class="img-fluid"/>
            </a>
        </div>
        <div class="col-md-3 mb-5">
            <a href="#;">
                <img src="/img/inter_img2.jpg"  class="img-fluid"/>
            </a>
        </div>
        <div class="col-md-3 mb-5">
            <a href="#;">
                <img src="/img/inter_img2.jpg"  class="img-fluid"/>
            </a>
        </div>
        <div class="col-md-3 mb-5">
            <a href="#;">
                <img src="/img/inter_img2.jpg"  class="img-fluid"/>
            </a>
        </div>
 -->    </div>
	<div class="text-center">
    <a href="<?php echo ($search_href)? $search_href : $list_href; ?>" class="btn button-style-2-1 mt-sm-5 mt-4">매장리스트 보기</a>
    </div>

</div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=8e4c52138aa49ff17f0dfc9859503942&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

// 지도를 생성합니다
var map = new daum.maps.Map(mapContainer, mapOption);

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new daum.maps.services.Geocoder();

// 주소로 좌표를 검색합니다
geocoder.addressSearch('<?php echo $view['wr_content'];?>', function(result,status) {

    // 정상적으로 검색이 완료됐으면
     if (status === daum.maps.services.Status.OK) {

        var coords = new daum.maps.LatLng(result[0].y, result[0].x);
				/*
				mapContainer = document.getElementById('map');
				mapOption = {
					center: new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng), // 지도의 중심좌표
					level: 3 // 지도의 확대 레벨
				};
				// 지도를 생성합니다
				map = new daum.maps.Map(mapContainer, mapOption);
				*/
        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker = new daum.maps.Marker({
            map: map,
            position: coords
        });

				var infowindow = new daum.maps.InfoWindow({
					content : '<div style="padding:2px;text-align:center;width:200px"><?php echo $view['wr_subject'];?></div>'
				});

				infowindow.open(map,marker);
				map.setCenter(coords);
    }
});
</script>