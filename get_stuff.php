<?php
include_once 'header.php';

include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$col = system_CleanVars($_REQUEST, 'col', '', 'string');
$val = system_CleanVars($_REQUEST, 'val', '', 'string');

if ('get_stuff' === $op) {
    $search_col = "{$col}_stuff";
} elseif ('get_cook' === $op) {
    $search_col = "{$col}_cook";
} else {
    exit;
}
$sql = "select `$search_col` from `" . $xoopsDB->prefix('tad_lunch2_data') . "` where `$col` = '$val' ";
$result = $xoopsDB->query($sql);

list($data) = $xoopsDB->fetchRow($result);
echo $data;
