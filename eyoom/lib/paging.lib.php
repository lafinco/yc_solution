<?php
/**
 * lib file : /eyoom/lib/paging.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 페이징 함수
 */
function eb_paging($skin_dir='basic') {
    global $config, $paging, $page, $total_page;

    if (!$skin_dir) $skin_dir = 'basic';
    $cur_page   = $page;
    $pg_pages   = $paging['pages'] ? $paging['pages']: 1;
    $pg_url     = $paging['url'];

    $pg_url     = preg_replace('#&amp;page=[0-9]*#', '', $pg_url).'&amp;page=';
    $start_page = (((int)(($cur_page-1)/$pg_pages))*$pg_pages)+1;
    $end_page   = $start_page+$pg_pages-1;

    if (!$total_page) $total_page = 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    $pg_str = array();
    if ($total_page > 1) {
        $i=0;
        for ($k=$start_page;$k<=$end_page;$k++) {
            $pg_str[$i]['url'] = $pg_url.$k.$add;
            $pg_str[$i]['page'] = $k;
            if ($cur_page != $k)
                $pg_str[$i]['on'] = false;
            else
                $pg_str[$i]['on'] = true;
            $i++;
        }
    }
    $pg_cnt = count($pg_str);

    /**
     * 페이지 링크 설정
     */
    $first_page = $pg_url . 1 . $add;
    $prev_page  = $pg_url . (($cur_page-1)<=0 ? 1: ($cur_page-1)) . $add;
    $next_page  = $pg_url . (($cur_page+1)>$total_page ? $total_page: ($cur_page+1)) . $add;
    $last_page  = $pg_url . $total_page . $add;

    /**
     * 스킨지정
     */
    if (G5_IS_MOBILE && $config['cf_eyoom_mobile_skin'] == '1') {
        $paging_skin_path = EYOOM_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/paging/'.$skin_dir;
        if (!is_dir($paging_skin_path))
            $paging_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/paging/'.$skin_dir;
        $paging_skin_url = str_replace(G5_PATH, G5_URL, $paging_skin_path);
    } else {
        $paging_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/paging/'.$skin_dir;
        $paging_skin_url = str_replace(G5_PATH, G5_URL, $paging_skin_path);
    }

    ob_start();
    include_once ($paging_skin_path.'/paging.skin.html.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}