<?php
include_once '../../mainfile.php';
include_once 'function.php';

//判斷是否對該模組有管理權限
$isAdmin = $isManager = false;
if ($xoopsUser) {
    $module_id = $xoopsModule->getVar('mid');
    $isAdmin = $xoopsUser->isAdmin($module_id);
    $isManager = in_array($xoopsUser->uid(), explode(',', $xoopsModuleConfig['lunch_manager'])) ? true : false;
}

$interface_menu[_TAD_TO_MOD] = 'index.php';
if ($isAdmin) {
    $interface_menu[_TAD_TO_ADMIN] = 'admin/main.php';
}
