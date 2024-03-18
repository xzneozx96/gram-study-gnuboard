<?php
	//include_once(G5_LIB_PATH.'/thumbnail.lib.php');

	$row = sql_fetch("select * from {$g5['write_prefix']}b202 where wr_id = '{$id}'");
	$file = get_file('b20', $id);

  $htmlImg = '';

	for ($i=0; $i<$file['count']; $i++){
		$htmlImg .= '<div class="swiper-slide" style="background-image:url('.$file[$i]['path'].'/'.$file[$i]['file'].')"></div>';
	}//end for

?>
<div class="space_wrap">
    <div class="container">
        <dl class="space_tlt">
            <dt class="kopubbatang"><?php echo get_text($row['wr_subject']);?></dt>
            <dd><?php echo conv_content($row['wr_content'],0);?></dd>
        </dl>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper"><?php echo $htmlImg;?></div>

            <div class="swiper-pagination swiper-pagination-white"></div>

        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
        <div class="swiper-container gallery-thumbs">
            <div class="swiper-wrapper"><?php echo $htmlImg;?></div>
        </div>
    </div>
</div>



<script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
		spaceBetween: 10,
		slidesPerView: 2,
		loop: true,
		freeMode: false,
		loopedSlides: 5, //looped slides should be the same
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		
		breakpoints: {
			380: {
			spaceBetween: 10,
			slidesPerView: 2,
			},
			
			768: {
			spaceBetween: 10,
			slidesPerView: 3,
			},
			1024: {
			spaceBetween: 10,
			slidesPerView: 4,
			},
		}
	  

    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      loop: true,
      loopedSlides: 5, //looped slides should be the same
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
	  pagination : {
				el : '.swiper-pagination',
				clickable : true,
			},
      thumbs: {
        swiper: galleryThumbs,
      },
    });
</script>