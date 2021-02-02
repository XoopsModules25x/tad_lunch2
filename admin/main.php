<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_lunch2_adm_main.tpl';
include_once 'header.php';
include_once '../function.php';

/*-----------功能函數區--------------*/

//tad_lunch2編輯表單
function tad_lunch2_form($lunch_sn = '')
{
    global $xoopsDB, $xoopsTpl;
    //include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
    //include_once(XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php");

    //抓取預設值
    if (!empty($lunch_sn)) {
        $DBV = get_tad_lunch2($lunch_sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「lunch_sn」欄位預設值
    $lunch_sn = !isset($DBV['lunch_sn']) ? $lunch_sn : $DBV['lunch_sn'];
    $xoopsTpl->assign('lunch_sn', $lunch_sn);

    //設定「lunch_title」欄位預設值
    $lunch_title = !isset($DBV['lunch_title']) ? null : $DBV['lunch_title'];
    $xoopsTpl->assign('lunch_title', $lunch_title);

    //設定「lunch_factory」欄位預設值
    $lunch_factory = !isset($DBV['lunch_factory']) ? '' : $DBV['lunch_factory'];
    $xoopsTpl->assign('lunch_factory', $lunch_factory);

    //設定「lunch_dietician」欄位預設值
    $lunch_dietician = !isset($DBV['lunch_dietician']) ? '' : $DBV['lunch_dietician'];
    $xoopsTpl->assign('lunch_dietician', $lunch_dietician);

    //設定「lunch_factory_tel」欄位預設值
    $lunch_factory_tel = !isset($DBV['lunch_factory_tel']) ? '' : $DBV['lunch_factory_tel'];
    $xoopsTpl->assign('lunch_factory_tel', $lunch_factory_tel);

    //設定「lunch_factory_fax」欄位預設值
    $lunch_factory_fax = !isset($DBV['lunch_factory_fax']) ? '' : $DBV['lunch_factory_fax'];
    $xoopsTpl->assign('lunch_factory_fax', $lunch_factory_fax);

    //設定「lunch_factory_addr」欄位預設值
    $lunch_factory_addr = !isset($DBV['lunch_factory_addr']) ? '' : $DBV['lunch_factory_addr'];
    $xoopsTpl->assign('lunch_factory_addr', $lunch_factory_addr);

    $op = (empty($lunch_sn)) ? 'insert_tad_lunch2' : 'update_tad_lunch2';
    //$op="replace_tad_lunch2";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('now_op', 'tad_lunch2_form');
    $xoopsTpl->assign('next_op', $op);
}

//新增資料到tad_lunch2中
function insert_tad_lunch2()
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['lunch_title'] = $myts->addSlashes($_POST['lunch_title']);
    $_POST['lunch_factory'] = $myts->addSlashes($_POST['lunch_factory']);
    $_POST['lunch_dietician'] = $myts->addSlashes($_POST['lunch_dietician']);
    $_POST['lunch_factory_tel'] = $myts->addSlashes($_POST['lunch_factory_tel']);
    $_POST['lunch_factory_fax'] = $myts->addSlashes($_POST['lunch_factory_fax']);
    $_POST['lunch_factory_addr'] = $myts->addSlashes($_POST['lunch_factory_addr']);

    $sql = 'insert into `' . $xoopsDB->prefix('tad_lunch2') . "`
  (`lunch_title` , `lunch_factory` , `lunch_dietician` , `lunch_factory_tel` , `lunch_factory_fax` , `lunch_factory_addr`)
  values('{$_POST['lunch_title']}' , '{$_POST['lunch_factory']}' , '{$_POST['lunch_dietician']}' , '{$_POST['lunch_factory_tel']}' , '{$_POST['lunch_factory_fax']}' , '{$_POST['lunch_factory_addr']}')";
    $xoopsDB->query($sql) or Utility::web_error($sql);

    //取得最後新增資料的流水編號
    $lunch_sn = $xoopsDB->getInsertId();

    return $lunch_sn;
}

//更新tad_lunch2某一筆資料
function update_tad_lunch2($lunch_sn = '')
{
    global $xoopsDB, $xoopsUser;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['lunch_title'] = $myts->addSlashes($_POST['lunch_title']);
    $_POST['lunch_factory'] = $myts->addSlashes($_POST['lunch_factory']);
    $_POST['lunch_dietician'] = $myts->addSlashes($_POST['lunch_dietician']);
    $_POST['lunch_factory_tel'] = $myts->addSlashes($_POST['lunch_factory_tel']);
    $_POST['lunch_factory_fax'] = $myts->addSlashes($_POST['lunch_factory_fax']);
    $_POST['lunch_factory_addr'] = $myts->addSlashes($_POST['lunch_factory_addr']);

    $sql = 'update `' . $xoopsDB->prefix('tad_lunch2') . "` set
   `lunch_title` = '{$_POST['lunch_title']}' ,
   `lunch_factory` = '{$_POST['lunch_factory']}' ,
   `lunch_dietician` = '{$_POST['lunch_dietician']}' ,
   `lunch_factory_tel` = '{$_POST['lunch_factory_tel']}' ,
   `lunch_factory_fax` = '{$_POST['lunch_factory_fax']}' ,
   `lunch_factory_addr` = '{$_POST['lunch_factory_addr']}'
  where `lunch_sn` = '$lunch_sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);

    return $lunch_sn;
}

//列出所有tad_lunch2資料
function list_tad_lunch2()
{
    global $xoopsDB, $xoopsTpl, $isAdmin;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_lunch2') . '` ';

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $all_content = [];
    $i = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $lunch_sn , $lunch_title , $lunch_factory , $lunch_dietician , $lunch_factory_tel , $lunch_factory_fax , $lunch_factory_addr
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $all_content[$i]['lunch_sn'] = $lunch_sn;
        $all_content[$i]['lunch_title'] = "<a href='{$_SERVER['PHP_SELF']}?lunch_sn={$lunch_sn}'>{$lunch_title}</a>";
        $all_content[$i]['lunch_factory'] = $lunch_factory;
        $all_content[$i]['lunch_dietician'] = $lunch_dietician;
        $all_content[$i]['lunch_factory_tel'] = $lunch_factory_tel;
        $all_content[$i]['lunch_factory_fax'] = $lunch_factory_fax;
        $all_content[$i]['lunch_factory_addr'] = $lunch_factory_addr;
        $i++;
    }

    //刪除確認的JS

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('isAdmin', $isAdmin);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('now_op', 'list_tad_lunch2');
}

//以流水號取得某筆tad_lunch2資料
function get_tad_lunch2($lunch_sn = '')
{
    global $xoopsDB;
    if (empty($lunch_sn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2') . "` where `lunch_sn` = '{$lunch_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//刪除tad_lunch2某筆資料資料
function delete_tad_lunch2($lunch_sn = '')
{
    global $xoopsDB, $isAdmin;
    $sql = 'delete from `' . $xoopsDB->prefix('tad_lunch2') . "` where `lunch_sn` = '{$lunch_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);
}

//以流水號秀出某筆tad_lunch2資料內容
function show_one_tad_lunch2($lunch_sn = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin;

    if (empty($lunch_sn)) {
        return;
    }
    $lunch_sn = (int) $lunch_sn;

    $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2') . "` where `lunch_sn` = '{$lunch_sn}' ";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $all = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $lunch_sn , $lunch_title , $lunch_factory , $lunch_dietician , $lunch_factory_tel , $lunch_factory_fax , $lunch_factory_addr
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    $xoopsTpl->assign('lunch_sn', $lunch_sn);
    $xoopsTpl->assign('lunch_title', "<a href='{$_SERVER['PHP_SELF']}?lunch_sn={$lunch_sn}'>{$lunch_title}</a>");
    $xoopsTpl->assign('lunch_factory', $lunch_factory);
    $xoopsTpl->assign('lunch_dietician', $lunch_dietician);
    $xoopsTpl->assign('lunch_factory_tel', $lunch_factory_tel);
    $xoopsTpl->assign('lunch_factory_fax', $lunch_factory_fax);
    $xoopsTpl->assign('lunch_factory_addr', $lunch_factory_addr);

    $xoopsTpl->assign('now_op', 'show_one_tad_lunch2');
    $xoopsTpl->assign('title', $lunch_title);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$lunch_sn = system_CleanVars($_REQUEST, 'lunch_sn', 0, 'int');
$lunch_data_sn = system_CleanVars($_REQUEST, 'lunch_data_sn', 0, 'int');

switch ($op) {
/*---判斷動作請貼在下方---*/

    //替換資料
    case 'replace_tad_lunch2':
        replace_tad_lunch2();
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //新增資料
    case 'insert_tad_lunch2':
        $lunch_sn = insert_tad_lunch2();
        header("location: {$_SERVER['PHP_SELF']}?lunch_sn=$lunch_sn");
        break;
    //更新資料
    case 'update_tad_lunch2':
        update_tad_lunch2($lunch_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //輸入表格
    case 'tad_lunch2_form':
        tad_lunch2_form($lunch_sn);
        break;
    //刪除資料
    case 'delete_tad_lunch2':
        delete_tad_lunch2($lunch_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        break;
    //預設動作
    default:
        if (empty($lunch_sn)) {
            list_tad_lunch2();
        } else {
            show_one_tad_lunch2($lunch_sn);
        }
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('isAdmin', true);
include_once 'footer.php';
