<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_month.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200800";

/**
 * 탭메뉴 활성화 구분자
 */
$visit_mode = 'visit_month';

include_once(EYOOM_ADMIN_CORE_PATH . '/member/visit.sub.php');

$max = 0;
$sum_count = 0;
$limit = '';

$sql_common = " from {$g5['visit_sum_table']} ";
$sql_search = " where (1) ";

if ($fr_date && $to_date) {
    $sql_search .= " and vs_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
} else {
    $limit = ' limit 100 ';
}

$sql = " select SUBSTRING(vs_date,1,7) as vs_month, SUM(vs_count) as cnt
            {$sql_common}
            {$sql_search}
            group by vs_month
            order by vs_month desc {$limit}";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row['vs_month']] = $row['cnt'];

    if ($row['cnt'] > $max) $max = $row['cnt'];

    $sum_count += $row['cnt'];
}

$i = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
if (count($arr)) {
    foreach ($arr as $key=>$value) {
        $count = $value;

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $list[$i]['key'] = $key;
        $list[$i]['s_rate'] = $s_rate;
        $list[$i]['count'] = $count;
        $list[$i]['value'] = $value;
        $i++;
    }
}