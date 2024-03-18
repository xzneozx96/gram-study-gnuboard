<?php
include_once('../../../../../common.php');
$wr2Re = sql_query("select gugun, idx from BRI_address where sido = '{$ca_name}' order by gugun asc");
?>
<option value="">구/군 선택</option>
<?php echo row_to_options($wr2Re,$write['wr_1'],true);?>