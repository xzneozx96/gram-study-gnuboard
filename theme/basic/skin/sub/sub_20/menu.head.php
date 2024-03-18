<link rel="stylesheet" href="<?=G5_THEME_URL?>/_bri/css/swiper-bundle.min.css">
<script src="<?php echo G5_JS_URL ?>/swiper-bundle.min.js"></script>

<?php if($id == '') $id = 1; ?>
<div class="sub_top">
    <div class="m_tlt">
        <p class="title" data-aos="fade-down" data-aos-delay="100">공간소개</p>
        <ul class="sort_nav" data-aos="fade-down" data-aos-delay="300">
            <li<?php if($id == 1) echo ' class="active"';?>><a href="/bri/sub.php?sub=sub_20&menu=10&id=1">오픈형</a></li>
            <li<?php if($id == 2) echo ' class="active"';?>><a href="/bri/sub.php?sub=sub_20&menu=10&id=2">1인석</a></li>
            <li<?php if($id == 3) echo ' class="active"';?>><a href="/bri/sub.php?sub=sub_20&menu=10&id=3">노트북존</a></li>
            <li<?php if($id == 4) echo ' class="active"';?>><a href="/bri/sub.php?sub=sub_20&menu=10&id=4">휴게실</a></li>
        </ul>
    </div>

    <div class="bg image type-b">
    </div>
</div>