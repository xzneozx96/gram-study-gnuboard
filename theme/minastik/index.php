<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

$bo_table = 'gallery';
$board = get_board_db($bo_table, true);
$tmp_write_table = $g5['write_prefix'] . $bo_table;

$portfolioItems = sql_query("
    SELECT *
    FROM {$tmp_write_table}
    ORDER BY wr_datetime DESC
    LIMIT 4
");

include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">최신글</h2>

<div class="main_content--wrap" id="fullpage">
	<!-- banner -->
	<div class="home_banner">
		<img src="<?=G5_THEME_URL?>/img/minastik/hero-decor.png" class="hero_decor" alt="hero_decor">
		<div class="decors">
			<div class="bubble b_one"></div>
			<div class="bubble b_two"></div>
			<div class="bubble b_three"></div>
			<div class="bubble b_four"></div>
			<div class="bubble b_five"></div>
			<div class="bubble b_six"></div>
			<div class="triangle t_one">
				<img src="<?=G5_THEME_URL?>/img/minastik/triangle_one.png" alt="triangle_one">
			</div>
			<div class="triangle t_two">
				<img src="<?=G5_THEME_URL?>/img/minastik/triangle_two.png" alt="triangle_two">
			</div>
		</div>

		<div class="banner_top">
			<div class="container">
				<div class="row">
					<!-- style 1 -->
					<div class="col-lg-5 align-self-center">
						<div class="banner_top--left">
							<h2 data-aos="fade-right" data-aos-delay="200">
								Thiết Kế và Phát Triển Website <br> Nâng Tầm Thương Hiệu
							</h2>
							<p data-aos="fade-right" data-aos-delay="400">
								Minastik luôn hướng đến những giải pháp công nghệ cao phù hợp với mọi yêu cầu, trải nghiệm của khách
								hàng mang lại hiệu quả kinh tế cho các doanh nghiệp
							</p>
							<a class="btn_get btn_hover d-inline-block" data-aos="fade-right" data-aos-delay="600" href="#contact">Liên hệ ngay</a>

						</div>
					</div>

					<div class="col-lg-7 align-self-center">
						<div class="banner_hero--wrap text-center">
							<img src="<?=G5_THEME_URL?>/img/minastik/banner_particle.png" class="banner_decor" alt="banner_decor">
							<img src="<?=G5_THEME_URL?>/img/minastik/hero-minastik.png" data-aos="fade-left" data-aos-delay="200"
								class="banner_hero--main" alt="banner_hero_main">
						</div>
					</div>

					<!-- style 2 -->
					<!-- <div class="col-lg-12">
						<div class="banner_top--left text-center">
							<h2>
								We Provide Hi-Tech Solutions <br> To Help You Grow Your Business
							</h2>
							<p>You need a website, a mobile app but don't know where to start?
								<br>
								You are struggling to increase traffic to your website?
								<br>
								Let get in touch to see how can we help you
							</p>
							<a class="btn_get btn_hover">Get In Touch</a>

						</div>
					</div>

					<div class="col-lg-12">
						<div class="banner_hero--wrap text-center">
							<img src="<?=G5_THEME_URL?>/img/minastik/banner_particle.png" class="banner_decor">
							<img src="<?=G5_THEME_URL?>/img/minastik/hero-minastik.png" class="banner_hero--main">
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>

	<!-- about -->
	<div class="about_us section" id="about">
		<div class="about--wrap">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 align-self-center">
						<div class="about_hero--wrap rtl pe-5">
							<img src="<?=G5_THEME_URL?>/img/minastik/about_hero.svg" data-aos="fade-right" data-aos-delay="200" alt="about_hero">
						</div>
					</div>

					<div class="col-lg-5 align-self-center">
						<div class="about--content">
							<span class="sub_title" data-aos="fade-up" data-aos-delay="200">welcome to minastik</span>
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Đôi điều về chúng tôi</h2>
							<ul>
								<li data-aos="fade-up" data-aos-delay="600">
									Tháng 05 năm 2021 Công ty CP Công nghệ Minastik được ra đời với mục đích và tôn chỉ hàng đầu là xây
									dựng
									một phong cách phục vụ đẳng cấp, đáp ứng càng ngày càng nhiều nhu cầu của khách hàng với thời gian
									ngày
									càng rút ngắn và hiệu quả ngày càng nâng cao.
								</li>
								<li data-aos="fade-up" data-aos-delay="800">
									Công ty CP Công nghệ Minastik tiến tới mục tiêu triển khai toàn diện các dịch vụ hỗ trợ và giải pháp
									kinh doanh và tiếp thị công nghệ số trên Internet tại Việt Nam và khu vực, giúp các doanh nghiệp
									khai
									thác tối đa sức mạnh của công nghệ thông tin, truyền thông kỹ thuật số và Internet trong việc phát
									triển
									kinh doanh.
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- services -->
	<div class="services section" id="services">
		<div class="services--wrap">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="services--title text-center">
							<!-- <span class="sub_title" data-aos="fade-up" data-aos-delay="200">what we do</span> -->
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Dịch vụ cung cấp bởi Minastik</h2>
							<p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Đội ngũ của chúng tôi luôn nỗ lực
								hết mình để tạo ra <br> những dịch vụ cao
								cấp nhất cho khách hàng</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-12 align-self-center">
						<div class="services--content">
							<div class="service_item active" data-aos="fade-right" data-aos-delay="400">
								<div class="service_item--thumb">
									<img src="<?=G5_THEME_URL?>/img/minastik/web-dev.svg" alt="web_dev">
								</div>
								<div class="service_item--content">
									<h4>Thiết kế và xây dựng website</h4>
									<p>Minastik mang đến những thiết kế độc đáo, ấn tượng với dịch vụ chuyên nghiệp, uy tín</p>
								</div>
							</div>

							<div class="service_item" data-aos="fade-right" data-aos-delay="600">
								<div class="service_item--thumb">
									<img src="<?=G5_THEME_URL?>/img/minastik/seo.svg" alt="seo">
								</div>
								<div class="service_item--content">
									<h4>Tối ưu hóa công cụ SEO</h4>
									<p>Với công nghệ tối ưu SEO riêng biệt nâng cao hiệu quả bán hàng, quảng bá thương hiệu cho doanh
										nghiệp</p>
								</div>
							</div>

							<div class="service_item" data-aos="fade-right" data-aos-delay="800">
								<div class="service_item--thumb">
									<img src="<?=G5_THEME_URL?>/img/minastik/mobile-dev.svg" alt="mobile_dev">
								</div>
								<div class="service_item--content">
									<h4>Phát triển ứng dụng di động</h4>
									<p>Ứng dụng các công nghệ hiện đại nhất, phù hợp với trải nghiệm của khách
										hàng theo từng doanh nghiệp</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6 col-md-12 align-self-center d-none d-lg-block">
						<div class="services--anmations">
							<div class="swiper-container services--main">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper ">
									<!-- Slides -->
									<div class="swiper-slide">
										<img src="<?=G5_THEME_URL?>/img/minastik/web-dev.gif" data-aos="zoom-in-left" data-aos-delay="1000" alt="web_dev">
									</div>
									<div class="swiper-slide">
										<img src="<?=G5_THEME_URL?>/img/minastik/SEO.gif" alt="SEO">
									</div>
									<div class="swiper-slide">
										<img src="<?=G5_THEME_URL?>/img/minastik/mobile-dev.gif" alt="mobile_dev">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- why minastik -->
	<div class="why_us section" id="why">
		<div class="why--wrap">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 align-items-center text-center">
						<div class="why--content">
							<!-- <span class="sub_title" data-aos="fade-up" data-aos-delay="200">we strive for satisfaction</span> -->
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Tại sao lựa chọn Minastik</h2>
							<p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Chúng tôi luôn nỗ lực hết mình
								trong từng sản phẩm
								để mang lại <br> trải nghiệm tốt nhất cho khách hàng</p>
						</div>
					</div>

					<div class="col-12">
						<div class="reasons_block row justify-content-center">
							<div class="col-lg-4 col-md-6">
								<div class="reason_item modern_tech text-center" data-aos="fade-right" data-aos-delay="400">
									<div class="reason_item--thumb">
										<img src="<?=G5_THEME_URL?>/img/minastik/hi-tech.png" alt="hi-tech">
									</div>
									<div class="reason_item--content">
										<h3>Công nghệ hiện đại</h3>
										<p>Tại Minastik, chúng tôi luôn nỗ lực cải tiến công nghệ để nâng cao trải nghiệm cho khách hàng
										</p>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<div class="reason_item secured text-center" data-aos="fade-up" data-aos-delay="600">
									<div class="reason_item--thumb">
										<img src="<?=G5_THEME_URL?>/img/minastik/secured.png" alt="secured">
									</div>
									<div class="reason_item--content">
										<h3>An toàn và bảo mật</h3>
										<p>An toàn và bảo mật thông tin người dùng luôn là ưu tiên hàng đầu trong từng sản phẩm của chúng
											tôi</p>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<div class="reason_item support text-center" data-aos="fade-left" data-aos-delay="800">
									<div class="reason_item--thumb">
										<img src="<?=G5_THEME_URL?>/img/minastik/why-minastik.png" alt="why-minastik">
									</div>
									<div class="reason_item--content">
										<h3>Hỗ trợ tận tình</h3>
										<p>Đội ngũ hỗ trợ của chúng tôi luôn sẵn sàng 24/7 để giải đáp mọi thắc mắc của bạn </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- workflow -->
	<div class="workflow section" id="process">
		<div class="workflow--wrap">
			<div class="decors">
				<div class="bubble b_one"></div>
				<div class="bubble b_two"></div>
				<div class="bubble b_three"></div>
				<div class="bubble b_four"></div>
				<div class="bubble b_five"></div>
				<div class="bubble b_six"></div>
				<div class="triangle t_one">
					<img src="<?=G5_THEME_URL?>/img/minastik/triangle_one.png" alt="triangle_one">
				</div>
				<div class="triangle t_two">
					<img src="<?=G5_THEME_URL?>/img/minastik/triangle_two.png" alt="triangle_two">
				</div>
			</div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-10 align-items-center text-center">
						<div class="why--content">
							<!-- <span class="sub_title" data-aos="fade-up" data-aos-delay="200">how we work</span> -->
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Quy trình làm việc tại Minastik</h2>
							<p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Dựa vào kinh nghiệm dày dặn, đội
								ngũ của chúng tôi đã tạo ra <br> một quy
								trình làm việc
								chuyên nghiệp và hiệu quả</p>
						</div>
					</div>

					<div class="col-md-8">
						<!-- Slider main container -->
						<div class="swiper-container workflow--main">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/talk-to-customer.gif" data-aos="zoom-in" data-aos-delay="400" alt="talk">
										</div>
										<div class="workflow_step--content">
											<p data-aos="fade-up" data-aos-delay="600">Bước 1</p>
											<h3 data-aos="fade-up" data-aos-delay="800">Thu thập thông tin khách hàng</h3>
										</div>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/analyze-customer.gif" alt="analyze">
										</div>
										<div class="workflow_step--content">
											<p>Bước 2</p>
											<h3>Phân tích yêu cầu</h3>
										</div>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/constructing.gif" alt="construc">
										</div>
										<div class="workflow_step--content">
											<p>Bước 3</p>
											<h3>Thiết kế và xây dựng hệ thống</h3>
										</div>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/miastik.gif" alt="minastik">
										</div>
										<div class="workflow_step--content">
											<p>Bước 4</p>
											<h3>Kiểm thử sản phẩm</h3>
										</div>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/hand-off-project.gif" alt="hand-off-project">
										</div>
										<div class="workflow_step--content">
											<p>Bước 5</p>
											<h3>Nghiệm thu và bàn giao</h3>
										</div>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="workflow_step text-center">
										<div class="workflow_step--animation">
											<img src="<?=G5_THEME_URL?>/img/minastik/warranty.gif" alt="warranty">
										</div>
										<div class="workflow_step--content">
											<p>Bước 6</p>
											<h3>Bảo hành sản phẩm</h3>
										</div>
									</div>
								</div>

							</div>
							<!-- If we need pagination -->
							<!-- <div class="swiper-pagination workflow--swiper-pagination"></div> -->

							<!-- If we need navigation buttons -->
							<div class="swiper-button-prev workflow--swiper-prev"></div>
							<div class="swiper-button-next workflow--swiper-next"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- payment steps -->
	<div class="payment section">
		<div class="payment--wrap">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10 text-center">
						<div class="payment--title">
							<!-- <span class="sub_title" data-aos="fade-up" data-aos-delay="200">get to know</span> -->
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Tiến độ thanh toán</h2>
							<p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Tiến độ có thể được chia thành 4
								hoặc 5 đợt <br> tùy theo độ dài thực tế của dự án</p>
						</div>
					</div>

					<div class="col-lg-10">
						<div class="payment--content row justify-content-center">
							<div class="col-lg-6 d-lg-block d-none rtl align-self-center">
								<img src="<?=G5_THEME_URL?>/img/minastik/payment_decor.svg" data-aos="fade-right" alt="payment_decor">
							</div>

							<div class="col-lg-6 col-md-10 align-self-center">
								<div class="payment--steps">
									<ul class="step--wrap">
										<li>
											<div class="step--thumb">
												<span>01</span>
											</div>
											<div class="step--content" data-aos="fade-left" data-aos-delay="800">
												<h5>Giai đoạn 1: 50%</h5>
												<p>Khách hàng thanh toán 50% giá trị hợp đồng ngay sau khi ký</p>
											</div>
										</li>

										<li>
											<div class="step--thumb">
												<span>02</span>
											</div>
											<div class="step--content step--2" data-aos="fade-left" data-aos-delay="1000">
												<h5>Giai đoạn 2: 30%</h5>
												<p>Ngay sau khi hoàn thành <br> 50% công việc</p>
											</div>
										</li>

										<li>
											<div class="step--thumb">
												<span>03</span>
											</div>
											<div class="step--content" data-aos="fade-left" data-aos-delay="1200">
												<h5>Giai đoạn 3: 20%</h5>
												<p>Khách hàng thanh toán phần còn lại của hợp đồng ngay sau khi nghiệm thu</p>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- portfolio -->
	<div class="portfolio section" id="portfolio">
		<div class="portfolio--wrap">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 align-items-center text-center">
						<div class="portfolio--content">
							<!-- <span class="sub_title" data-aos="fade-up" data-aos-delay="200">our projects</span> -->
							<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Dự án của chúng tôi</h2>
							<!-- <p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Ở Minastik, mỗi dự án đều được chú
								trọng và phát triển một cách tâm huyết. <br> Chúng tôi luôn luôn tự hào về những dự án của mình</p> -->
						</div>
					</div>
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

								<div class="portfolio--block" target="_blank" onclick="visitSite('<?= htmlspecialchars($item['wr_link1']) ?>')" data-aos="fade-left" data-aos-delay="<?= 800 + ($index * 200) ?>">
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

						<button class="btn view-more" data-aos="fade-up" data-aos-delay="1400"><a href="./bbs/portfolio.php">Xem
								thêm</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- contact -->
	<div class="contact section" id="contact">
		<img src="<?=G5_THEME_URL?>/img/minastik/contact_bg.svg" class="contact_bg" alt="contact">
		<div class="container">
			<div class="contact--title text-center">
				<span class="sub_title" data-aos="fade-up" data-aos-delay="200">we are here to help you</span>
				<h2 class="section_title" data-aos="fade-up" data-aos-delay="400">Bạn đang tìm kiếm giải pháp công nghệ?
				</h2>
				<p class="mb-0 section_desc" data-aos="fade-up" data-aos-delay="600">Minastik luôn ở đây và sẵn sàng giúp
					đỡ <br> mọi lúc mọi nơi</p>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-9" style="align-self: center;">
					<div class="contact-info">
						<div class="contact-item" data-aos="fade-up" data-aos-delay="700">
							<div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/email-us.png" alt="email"></div>
							<div class="contact-item-content">
								<h5>Gửi email cho chúng tôi</h5><span>info@minastik.com</span>
							</div>
						</div>
						<div class="contact-item" data-aos="fade-up" data-aos-delay="900">
							<div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/call-us.png" alt="call"></div>
							<div class="contact-item-content">
								<h5>Gọi cho chúng tôi</h5><span>(+84) 938-016-586</span>
							</div>
						</div>
						<div class="contact-item" data-aos="fade-up" data-aos-delay="1100">
							<div class="contact-thumb"><img src="<?=G5_THEME_URL?>/img/minastik/visit-us.png" alt="visit"></div>
							<div class="contact-item-content">
								<h5>Địa chỉ của chúng tôi</h5><span> Số 8, Tổ 24 phố Vĩnh Tuy, Phường Vĩnh Tuy, Quận Hai Bà Trưng, Thành phố Hà Nội, Việt Nam </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');