<?php
include_once('../../common.php');

// Xin chào 사용여부
if(defined('G5_COMMUNITY_USE') && G5_COMMUNITY_USE === false) {
    define('_SHOP_', true);
}