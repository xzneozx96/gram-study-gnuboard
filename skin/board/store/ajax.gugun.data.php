<?php
include_once('../../../common.php');
$wr2Re = sql_query("select gugun, idx from g5_address where sido = '{$wr_1}' order by gugun asc");
?>
<option value="">구/군 선택</option>
<?php echo row_to_options($wr2Re,$write['wr_2'],true);?>