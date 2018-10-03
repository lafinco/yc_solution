<?php
/**
 * file : /eyoom/tail.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 모바일일 경우 & device=mobile
 */
if (G5_IS_MOBILE && $config['cf_eyoom_mobile_skin'] == '1') {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

/**
 * 커뮤니티 기능을 사용하지 않거나
 * 게시판의 설정이 쇼핑몰 레이아웃 적용일때
 */
if (G5_COMMUNITY_USE === false || (isset($eyoom_board['use_shop_skin']) && $eyoom_board['use_shop_skin'] == 'y' && $eyoom['use_layout_community'] == 'n')) {
    @include_once(EYOOM_CORE_PATH.'/shop/shop.tail.php');
    return;
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH . '/tail.php');

/**
 * 하단 html 출력
 */
include_once(EYOOM_THEME_PATH . '/tail.html.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_PATH."/tail.sub.php");