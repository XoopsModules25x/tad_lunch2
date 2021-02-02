<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_lunch2_adm_man.tpl';
include_once 'header.php';
include_once '../function.php';

/*-----------功能函數區--------------*/
function tad_lunch2_mem_setup($lunch_sn = '')
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl;

    $exist_uid = explode(',', $xoopsModuleConfig['lunch_manager']);

    $sql = 'SELECT uid,name,uname,email FROM ' . $xoopsDB->prefix('users') . ' ';

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $myts = \MyTextSanitizer::getInstance();
    $destination = $repository = [];
    $i = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $name = $myts->htmlSpecialChars($name);
        $uname = $myts->htmlSpecialChars($uname);
        if (empty($name)) {
            $name = $uname;
        }

        if (in_array($uid, $exist_uid)) {
            $destination[$i]['uid'] = $uid;
            $destination[$i]['name'] = $name;
            $destination[$i]['email'] = $email;
        } else {
            $repository[$i]['uid'] = $uid;
            $repository[$i]['name'] = $name;
            $repository[$i]['email'] = $email;
        }

        $i++;
    }

    $xoopsTpl->assign('destination', $destination);
    $xoopsTpl->assign('repository', $repository);
    $xoopsTpl->assign('tad_lunch2_man_arr', $xoopsModuleConfig['lunch_manager']);
}

function save_tad_lunch2_mem()
{
    global $xoopsDB;

    $sql = 'update `' . $xoopsDB->prefix('config') . "` set
    `conf_value` = '{$_POST['tad_lunch2_man_arr']}'
    where `conf_name` = 'lunch_manager'";

    $xoopsDB->queryF($sql) or Utility::web_error($sql);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');

switch ($op) {
/*---判斷動作請貼在下方---*/

    //替換資料
    case 'save_tad_lunch2_mem':
        save_tad_lunch2_mem();
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //預設動作
    default:
        tad_lunch2_mem_setup();
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('isAdmin', true);
include_once 'footer.php';
