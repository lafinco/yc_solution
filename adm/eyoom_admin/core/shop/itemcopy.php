<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemcopy.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

auth_check($auth[$sub_menu], "r");

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="button" value="복사하기" id="btn_submit" class="btn-e btn-e-lg btn-e-red" onclick="_copy();">' ;
$frm_submit .= ' </div>';