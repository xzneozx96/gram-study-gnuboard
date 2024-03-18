<?php
if (!defined('_GNUBOARD_')) exit;

function post($url, $fields)
{
    $post_field_string = http_build_query($fields, '', '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}

//중앙서버 키값
$thisSiteKey = 'OThkZFdBTis4Z1hjSWxYc1JIUVFWQT09';
$thisSiteResult = json_decode(post('13.125.2.231/API/', array('TYPE'=>'SITE_INFO', 'URL'=>$thisSiteKey,  'HOST'=>$_SERVER['HTTP_HOST'])), true);

if($thisSiteResult['result'] == 'False')
    die($thisSiteResult['message']);

