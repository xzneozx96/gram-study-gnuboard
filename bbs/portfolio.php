<?php
  include_once('./_common.php');

  $bo_table = 'gallery';
  $board = get_board_db($bo_table, true);
  $tmp_write_table = $g5['write_prefix'] . $bo_table;

  $portfolioItems = sql_query("
      SELECT *
      FROM {$tmp_write_table}
      ORDER BY wr_datetime DESC
  ");
  
  include_once(G5_THEME_PATH.'/head.php');
?>

<!-- hero banner -->
<div class="portfolio_hero sub_page_banner">
  <div class="container">
    <div class="page_title">
      <h1 class="mb-5">Portfolio</h1>

      <a href="<?php echo G5_URL ?>" class="btn_get btn_hover d-inline-block">Trở về trang chủ</a>
      <!-- <ul class="portfolio_breadcrumb">
        <li><a href="/index.html">Trang chủ<i class='bx bx-arrow-back' style="transform: rotate(180deg);"></i></a>
        </li>
        <li>Portfolio</li>
      </ul> -->
    </div>
  </div>
</div>

<!-- portfolio showcase -->
<div class=" section portfolio_showcase">
  <div class="container">
    <div class="contact--title text-center">
      <h2 class="section_title"="fade-up">Dự án của Minastik?
      </h2>
      <p class="mb-0 section_desc"="fade-up">Chúng tôi luôn luôn tự hào về những dự án của mình. <br> Ở Minastik, mỗi
        dự án đều được chú trọng và phát triển một cách tâm huyết nhất</p>
    </div>

    <div class="row">
      <div class="col-12">
          <div class="portfolio--main">
            <?php foreach ($portfolioItems as $index => $item): ?>
              <?php 
                  $sql = "SELECT * FROM {$g5['board_file_table']} WHERE bo_table = 'gallery' AND wr_id = '" . $item['wr_id'] . "'";

                  $file = sql_fetch($sql);  

                  $fileurl = run_replace('get_file_board_url', G5_DATA_URL.'/file/'.$bo_table.'/'.$file['bf_file'], $bo_table);
                ?>

              <div class="portfolio--block" target="_blank" onclick="visitSite('<?= htmlspecialchars($item['wr_link1']) ?>')" data-aos="fade-left" data-aos-delay="<?= $index * 100 ?>">
                <div class="portfolio-thumb" style="background-image: url(<?= htmlspecialchars($fileurl) ?>);"></div>

                <div class="portfolio-meta">
                  <div class="meta-data">
                      <h4><?= htmlspecialchars($item['wr_subject']) ?></h4>
                      <p class="mb-0"><?= htmlspecialchars($item['wr_content']) ?></p>
                  </div>

                  <a rel="noreferrer" target="_blank" href="<?= htmlspecialchars($item['wr_link1']) ?>">
                      <i class='bx bx-link-external'></i>
                  </a>
                  </div>
              </div>
            <?php endforeach; ?>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>


<!-- contact -->
<div class="contact section portfolio--contact">
  <img src="<?=G5_THEME_URL?>/img/minastik/contact_bg.svg" class="contact_bg" alt="contact">
  <div class="container">
    <div class="contact--title text-center">
      <!-- <span class="sub_title"="fade-up">we are here to help you</span> -->
      <h2 class="section_title"="fade-up">Bạn đang tìm kiếm giải pháp công nghệ?
      </h2>
      <p class="mb-0 section_desc"="fade-up">Minastik luôn ở đây và sẵn sàng giúp
        đỡ <br> mọi lúc mọi nơi</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-9" style="align-self: center;">
        <div class="contact-info">
          <div class="contact-item"="fade-up">
            <div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/email-us.png" alt="email"></div>
            <div class="contact-item-content">
              <h5>Gửi email cho chúng tôi</h5><span>info@minastik.com</span>
            </div>
          </div>
          <div class="contact-item"="fade-up">
            <div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/call-us.png" alt="call"></div>
            <div class="contact-item-content">
              <h5>Gọi cho chúng tôi</h5><span>(+84) 938-016-586</span>
            </div>
          </div>
          <div class="contact-item"="fade-up">
            <div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/visit-us.png" alt="visit"></div>
            <div class="contact-item-content">
              <h5>Địa chỉ của chúng tôi</h5><span> Số 8, Tổ 24 phố Vĩnh Tuy, Phường Vĩnh Tuy, Quận Hai Bà Trưng, Thành
                phố Hà Nội, Việt Nam </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include_once(G5_THEME_PATH."/tail.php");
?>

<!-- internal JS -->
<script type="text/javascript" src="<?=G5_THEME_URL?>/js/minastik/aos.js"></script>
<script type="text/javascript" src="<?=G5_THEME_URL?>/js/minastik/main.js"></script>
<script type="text/javascript" src="<?=G5_THEME_URL?>/js/minastik/header.js"></script>