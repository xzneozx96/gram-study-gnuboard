<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
  
      <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
      <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
      <input type="hidden" name="stx" value="<?php echo $stx ?>">
      <input type="hidden" name="spt" value="<?php echo $spt ?>">
      <input type="hidden" name="sca" value="<?php echo $sca ?>">
      <input type="hidden" name="sst" value="<?php echo $sst ?>">
      <input type="hidden" name="sod" value="<?php echo $sod ?>">
      <input type="hidden" name="page" value="<?php echo $page ?>">
      <input type="hidden" name="sw" value="">

      <!-- hero banner -->
      <div class="blog_hero sub_page_banner">
        <div class="container">
          <div class="page_title">
            <h1 class="mb-5">Blogs</h1>

            <a href="<?php echo G5_URL ?>" class="btn_get btn_hover d-inline-block">Trở về trang chủ</a>
            <!-- <ul class="portfolio_breadcrumb">
              <li><a href="/index.html">Trang chủ<i class='bx bx-arrow-back' style="transform: rotate(180deg);"></i></a>
              </li>
              <li>Portfolio</li>
            </ul> -->
          </div>
        </div>
      </div>

      <!-- blog list -->
      <div class="blogs-wrap container">
        <div class="row">
          <!-- 게시판 페이지 정보 및 버튼 시작 { -->
          <div id="bo_btn_top">
            <?php if ($is_auth) { ?>
              <ul class="btn_bo_user">
                <?php if ($admin_href) { ?>
                  <li>
                    <a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자">
                      <i class="fa fa-cog fa-spin fa-fw"></i>
                      <span class="sound_only">관리자</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if ($rss_href) { ?>
                  <li>
                    <a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS">
                      <i class="fa fa-rss" aria-hidden="true"></i>
                      <span class="sound_only">RSS</span>
                    </a>
                  </li>
                <?php } ?>
                  
                <li>
                  <button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button>
                </li>

                <?php if ($write_href) { ?>
                  <li>
                    <a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                      <span class="sound_only">글쓰기</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if ($is_admin == 'super' || $is_auth) {  ?>
                  <li>
                    <button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
                    <?php if ($is_checkbox) { ?>	
                    <ul class="more_opt is_list_btn">  
                        <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
                        <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
                        <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
                    </ul>
                    <?php } ?>
                  </li>
                <?php }  ?>
              </ul>
            <?php } ?>
          </div>
          <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        </div>
        <div class="row">
          <?php foreach ($list as $index => $item): ?>
            <?php 
              $sql = "SELECT * FROM {$g5['board_file_table']} WHERE bo_table = 'notice' AND wr_id = '" . $item['wr_id'] . "'";

              $file = sql_fetch($sql);  

              $fileurl = run_replace('get_file_board_url', G5_DATA_URL.'/file/'.$bo_table.'/'.$file['bf_file'], $bo_table);
            ?>

          <div class="col-sm-12 col-md-6 col-lg-4 blog-item-wrap">
            <div class="blog-item">
              <div class="blog-item-header">
                <img src="<?= $fileurl ?>" alt="blog-thumb" />
              </div>
              <div class="blog-item-body">
                <h4>
                  <a href="<?php echo $item['href'] ?>"><?= htmlspecialchars($item['subject']) ?></a>  
                </h4>
                <div class="short-desc"><?= $item['wr_content'] ?></div>
                <div class="blog-item-user">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/4/48/Outdoors-man-portrait_%28cropped%29.jpg" alt="" />
                  <div class="user-info">
                    <h5><?= htmlspecialchars($item['wr_name']) ?></h5>
                    <small><?= htmlspecialchars($item['datetime2']) ?>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <!-- </div> -->

    <!-- 페이지 -->
    <?php echo $write_pages; ?>

    <!-- 페이지 -->
      <?php if ($list_href || $is_checkbox || $write_href) { ?>
      <div class="bo_fx">
          <?php if ($list_href || $write_href) { ?>
          <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
              <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
              <?php if ($write_href && $is_auth) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
          </ul>	
          <?php } ?>
      </div>
      <?php } ?>   
    </form>
    <!-- } 게시판 검색 끝 --> 
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
