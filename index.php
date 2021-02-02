<?php
use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
include 'header.php';
$xoopsOption['template_main'] = 'tad_lunch2_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$TadUpFiles = new TadUpFiles('tad_lunch2');
/*-----------功能函數區--------------*/

//tad_lunch2_data編輯表單
function tad_lunch2_data_form($lunch_data_sn = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig, $TadUpFiles, $isManager;

    if (!$isManager) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_TADLUNCH2_NEED_MANAGER);
    }

    //抓取預設值
    if (!empty($lunch_data_sn)) {
        $DBV = get_tad_lunch2_data($lunch_data_sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「lunch_data_sn」欄位預設值
    $lunch_data_sn = !isset($DBV['lunch_data_sn']) ? $lunch_data_sn : $DBV['lunch_data_sn'];
    $xoopsTpl->assign('lunch_data_sn', $lunch_data_sn);

    //設定「lunch_target」欄位預設值
    $lunch_target = !isset($DBV['lunch_target']) ? '' : $DBV['lunch_target'];
    $xoopsTpl->assign('lunch_target', $lunch_target);

    //設定「lunch_sn」欄位預設值
    $lunch_sn = !isset($DBV['lunch_sn']) ? '' : $DBV['lunch_sn'];
    $xoopsTpl->assign('lunch_sn', $lunch_sn);

    //設定「lunch_date」欄位預設值
    $lunch_date = !isset($DBV['lunch_date']) ? date('Y-m-d') : $DBV['lunch_date'];
    $xoopsTpl->assign('lunch_date', $lunch_date);

    //設定「main_food」欄位預設值
    $main_food = !isset($DBV['main_food']) ? '' : $DBV['main_food'];
    $xoopsTpl->assign('main_food', $main_food);

    //設定「main_food_stuff」欄位預設值
    $main_food_stuff = !isset($DBV['main_food_stuff']) ? '' : $DBV['main_food_stuff'];
    $xoopsTpl->assign('main_food_stuff', $main_food_stuff);

    //設定「main_dish」欄位預設值
    $main_dish = !isset($DBV['main_dish']) ? '' : $DBV['main_dish'];
    $xoopsTpl->assign('main_dish', $main_dish);

    //設定「main_dish_stuff」欄位預設值
    $main_dish_stuff = !isset($DBV['main_dish_stuff']) ? '' : $DBV['main_dish_stuff'];
    $xoopsTpl->assign('main_dish_stuff', $main_dish_stuff);

    //設定「main_dish_cook」欄位預設值
    $main_dish_cook = !isset($DBV['main_dish_cook']) ? '' : $DBV['main_dish_cook'];
    $xoopsTpl->assign('main_dish_cook', $main_dish_cook);

    //設定「side_dish1」欄位預設值
    $side_dish1 = !isset($DBV['side_dish1']) ? '' : $DBV['side_dish1'];
    $xoopsTpl->assign('side_dish1', $side_dish1);

    //設定「side_dish1_stuff」欄位預設值
    $side_dish1_stuff = !isset($DBV['side_dish1_stuff']) ? '' : $DBV['side_dish1_stuff'];
    $xoopsTpl->assign('side_dish1_stuff', $side_dish1_stuff);

    //設定「side_dish1_cook」欄位預設值
    $side_dish1_cook = !isset($DBV['side_dish1_cook']) ? '' : $DBV['side_dish1_cook'];
    $xoopsTpl->assign('side_dish1_cook', $side_dish1_cook);

    //設定「side_dish2」欄位預設值
    $side_dish2 = !isset($DBV['side_dish2']) ? '' : $DBV['side_dish2'];
    $xoopsTpl->assign('side_dish2', $side_dish2);

    //設定「side_dish2_stuff」欄位預設值
    $side_dish2_stuff = !isset($DBV['side_dish2_stuff']) ? '' : $DBV['side_dish2_stuff'];
    $xoopsTpl->assign('side_dish2_stuff', $side_dish2_stuff);

    //設定「side_dish2_cook」欄位預設值
    $side_dish2_cook = !isset($DBV['side_dish2_cook']) ? '' : $DBV['side_dish2_cook'];
    $xoopsTpl->assign('side_dish2_cook', $side_dish2_cook);

    //設定「side_dish3」欄位預設值
    $side_dish3 = !isset($DBV['side_dish3']) ? '' : $DBV['side_dish3'];
    $xoopsTpl->assign('side_dish3', $side_dish3);

    //設定「side_dish3_stuff」欄位預設值
    $side_dish3_stuff = !isset($DBV['side_dish3_stuff']) ? '' : $DBV['side_dish3_stuff'];
    $xoopsTpl->assign('side_dish3_stuff', $side_dish3_stuff);

    //設定「side_dish3_cook」欄位預設值
    $side_dish3_cook = !isset($DBV['side_dish3_cook']) ? '' : $DBV['side_dish3_cook'];
    $xoopsTpl->assign('side_dish3_cook', $side_dish3_cook);

    //設定「fruit」欄位預設值
    $fruit = !isset($DBV['fruit']) ? '' : $DBV['fruit'];
    $xoopsTpl->assign('fruit', $fruit);

    //設定「soup」欄位預設值
    $soup = !isset($DBV['soup']) ? '' : $DBV['soup'];
    $xoopsTpl->assign('soup', $soup);

    //設定「soup_stuff」欄位預設值
    $soup_stuff = !isset($DBV['soup_stuff']) ? '' : $DBV['soup_stuff'];
    $xoopsTpl->assign('soup_stuff', $soup_stuff);

    //設定「soup_cook」欄位預設值
    $soup_cook = !isset($DBV['soup_cook']) ? '' : $DBV['soup_cook'];
    $xoopsTpl->assign('soup_cook', $soup_cook);

    //設定「protein」欄位預設值
    $protein = !isset($DBV['protein']) ? '' : $DBV['protein'];
    $xoopsTpl->assign('protein', $protein);

    //設定「fat」欄位預設值
    $fat = !isset($DBV['fat']) ? '' : $DBV['fat'];
    $xoopsTpl->assign('fat', $fat);

    //設定「carbohydrate」欄位預設值
    $carbohydrate = !isset($DBV['carbohydrate']) ? '' : $DBV['carbohydrate'];
    $xoopsTpl->assign('carbohydrate', $carbohydrate);

    //設定「calorie」欄位預設值
    $calorie = !isset($DBV['calorie']) ? '' : $DBV['calorie'];
    $xoopsTpl->assign('calorie', $calorie);

    $op = (empty($lunch_data_sn)) ? 'insert_tad_lunch2_data' : 'update_tad_lunch2_data';
    //$op="replace_tad_lunch2_data";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('now_op', 'tad_lunch2_data_form');
    $xoopsTpl->assign('next_op', $op);
    $xoopsTpl->assign('lunch_company', get_tad_lunch2_all());

    $lunch_target_opt = explode(';', $xoopsModuleConfig['lunch_target']);
    $i = 0;
    foreach ($lunch_target_opt as $title) {
        $lunch_target_menu[$i]['title'] = $title;
        $i++;
    }
    $xoopsTpl->assign('lunch_target_menu', $lunch_target_menu);
    $xoopsTpl->assign('main_food_source', get_source('main_food'));
    $xoopsTpl->assign('main_dish_source', get_source('main_dish'));
    $xoopsTpl->assign('side_dish1_source', get_source('side_dish1'));
    $xoopsTpl->assign('side_dish2_source', get_source('side_dish2'));
    $xoopsTpl->assign('side_dish3_source', get_source('side_dish3'));
    $xoopsTpl->assign('fruit_source', get_source('fruit'));
    $xoopsTpl->assign('soup_source', get_source('soup'));

    $TadUpFiles->set_col('lunch_data_sn', $lunch_data_sn); //若 $show_list_del_file ==true 時一定要有
    $upform = $TadUpFiles->upform(false, 'lunch');
    $xoopsTpl->assign('upform', $upform);
}

//取得過去菜單提示來源
function get_source($col = 'main_food')
{
    global $xoopsDB, $TadUpFiles;
    $arr = [];
    $sql = "select `{$col}` from `" . $xoopsDB->prefix('tad_lunch2_data') . "` group by `{$col}` order by `{$col}`";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    while (list($data) = $xoopsDB->fetchRow($result)) {
        $arr[] = $data;
    }
    $main = "'" . implode("','", $arr) . "'";

    return $main;
}

//新增資料到tad_lunch2_data中
function insert_tad_lunch2_data()
{
    global $xoopsDB, $xoopsUser, $xoopsModuleConfig, $TadUpFiles;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['lunch_date'] = $myts->addSlashes($_POST['lunch_date']);
    $_POST['lunch_target'] = $myts->addSlashes($_POST['lunch_target']);
    $_POST['main_food'] = $myts->addSlashes($_POST['main_food']);
    $_POST['main_food_stuff'] = $myts->addSlashes($_POST['main_food_stuff']);
    $_POST['main_dish'] = $myts->addSlashes($_POST['main_dish']);
    $_POST['main_dish_stuff'] = $myts->addSlashes($_POST['main_dish_stuff']);
    $_POST['main_dish_cook'] = $myts->addSlashes($_POST['main_dish_cook']);
    $_POST['side_dish1'] = $myts->addSlashes($_POST['side_dish1']);
    $_POST['side_dish1_stuff'] = $myts->addSlashes($_POST['side_dish1_stuff']);
    $_POST['side_dish1_cook'] = $myts->addSlashes($_POST['side_dish1_cook']);
    $_POST['side_dish2'] = $myts->addSlashes($_POST['side_dish2']);
    $_POST['side_dish2_stuff'] = $myts->addSlashes($_POST['side_dish2_stuff']);
    $_POST['side_dish2_cook'] = $myts->addSlashes($_POST['side_dish2_cook']);
    $_POST['side_dish3'] = $myts->addSlashes($_POST['side_dish3']);
    $_POST['side_dish3_stuff'] = $myts->addSlashes($_POST['side_dish3_stuff']);
    $_POST['side_dish3_cook'] = $myts->addSlashes($_POST['side_dish3_cook']);
    $_POST['fruit'] = $myts->addSlashes($_POST['fruit']);
    $_POST['soup'] = $myts->addSlashes($_POST['soup']);
    $_POST['soup_stuff'] = $myts->addSlashes($_POST['soup_stuff']);
    $_POST['soup_cook'] = $myts->addSlashes($_POST['soup_cook']);
    $_POST['protein'] = $myts->addSlashes($_POST['protein']);
    $_POST['fat'] = $myts->addSlashes($_POST['fat']);
    $_POST['carbohydrate'] = $myts->addSlashes($_POST['carbohydrate']);
    $_POST['calorie'] = $myts->addSlashes($_POST['calorie']);

    $sql = 'insert into `' . $xoopsDB->prefix('tad_lunch2_data') . "`
  (`lunch_target`,`lunch_sn` , `lunch_date` , `main_food` , `main_food_stuff` , `main_dish` , `main_dish_stuff` , `main_dish_cook` , `side_dish1` , `side_dish1_stuff` , `side_dish1_cook` , `side_dish2` , `side_dish2_stuff` , `side_dish2_cook` , `side_dish3` , `side_dish3_stuff` , `side_dish3_cook` , `fruit` , `soup` , `soup_stuff` , `soup_cook` , `protein` , `fat` , `carbohydrate` , `calorie`)
  values('{$_POST['lunch_target']}','{$_POST['lunch_sn']}' , '{$_POST['lunch_date']}' , '{$_POST['main_food']}' , '{$_POST['main_food_stuff']}' , '{$_POST['main_dish']}' , '{$_POST['main_dish_stuff']}' , '{$_POST['main_dish_cook']}' , '{$_POST['side_dish1']}' , '{$_POST['side_dish1_stuff']}' , '{$_POST['side_dish1_cook']}' , '{$_POST['side_dish2']}' , '{$_POST['side_dish2_stuff']}' , '{$_POST['side_dish2_cook']}' , '{$_POST['side_dish3']}' , '{$_POST['side_dish3_stuff']}' , '{$_POST['side_dish3_cook']}' , '{$_POST['fruit']}' , '{$_POST['soup']}' , '{$_POST['soup_stuff']}' , '{$_POST['soup_cook']}' , '{$_POST['protein']}' , '{$_POST['fat']}' , '{$_POST['carbohydrate']}' , '{$_POST['calorie']}')";
    $xoopsDB->query($sql) or Utility::web_error($sql);

    //取得最後新增資料的流水編號
    $lunch_data_sn = $xoopsDB->getInsertId();

    $TadUpFiles->set_col('lunch_data_sn', $lunch_data_sn);
    $desc = sprintf(_MD_TADLUNCH2_PIC_DESC, $_POST['lunch_date']);
    $TadUpFiles->upload_file('lunch', 1024, 400, null, $desc, true);

    return $lunch_data_sn;
}

//更新tad_lunch2_data某一筆資料
function update_tad_lunch2_data($lunch_data_sn = '')
{
    global $xoopsDB, $xoopsUser, $TadUpFiles;

    $myts = \MyTextSanitizer::getInstance();
    $_POST['lunch_date'] = $myts->addSlashes($_POST['lunch_date']);
    $_POST['lunch_target'] = $myts->addSlashes($_POST['lunch_target']);
    $_POST['main_food'] = $myts->addSlashes($_POST['main_food']);
    $_POST['main_food_stuff'] = $myts->addSlashes($_POST['main_food_stuff']);
    $_POST['main_dish'] = $myts->addSlashes($_POST['main_dish']);
    $_POST['main_dish_stuff'] = $myts->addSlashes($_POST['main_dish_stuff']);
    $_POST['main_dish_cook'] = $myts->addSlashes($_POST['main_dish_cook']);
    $_POST['side_dish1'] = $myts->addSlashes($_POST['side_dish1']);
    $_POST['side_dish1_stuff'] = $myts->addSlashes($_POST['side_dish1_stuff']);
    $_POST['side_dish1_cook'] = $myts->addSlashes($_POST['side_dish1_cook']);
    $_POST['side_dish2'] = $myts->addSlashes($_POST['side_dish2']);
    $_POST['side_dish2_stuff'] = $myts->addSlashes($_POST['side_dish2_stuff']);
    $_POST['side_dish2_cook'] = $myts->addSlashes($_POST['side_dish2_cook']);
    $_POST['side_dish3'] = $myts->addSlashes($_POST['side_dish3']);
    $_POST['side_dish3_stuff'] = $myts->addSlashes($_POST['side_dish3_stuff']);
    $_POST['side_dish3_cook'] = $myts->addSlashes($_POST['side_dish3_cook']);
    $_POST['fruit'] = $myts->addSlashes($_POST['fruit']);
    $_POST['soup'] = $myts->addSlashes($_POST['soup']);
    $_POST['soup_stuff'] = $myts->addSlashes($_POST['soup_stuff']);
    $_POST['soup_cook'] = $myts->addSlashes($_POST['soup_cook']);
    $_POST['protein'] = $myts->addSlashes($_POST['protein']);
    $_POST['fat'] = $myts->addSlashes($_POST['fat']);
    $_POST['carbohydrate'] = $myts->addSlashes($_POST['carbohydrate']);
    $_POST['calorie'] = $myts->addSlashes($_POST['calorie']);

    $sql = 'update `' . $xoopsDB->prefix('tad_lunch2_data') . "` set
   `lunch_target` = '{$_POST['lunch_target']}' ,
   `lunch_sn` = '{$_POST['lunch_sn']}' ,
   `lunch_date` = '{$_POST['lunch_date']}' ,
   `main_food` = '{$_POST['main_food']}' ,
   `main_food_stuff` = '{$_POST['main_food_stuff']}' ,
   `main_dish` = '{$_POST['main_dish']}' ,
   `main_dish_stuff` = '{$_POST['main_dish_stuff']}' ,
   `main_dish_cook` = '{$_POST['main_dish_cook']}' ,
   `side_dish1` = '{$_POST['side_dish1']}' ,
   `side_dish1_stuff` = '{$_POST['side_dish1_stuff']}' ,
   `side_dish1_cook` = '{$_POST['side_dish1_cook']}' ,
   `side_dish2` = '{$_POST['side_dish2']}' ,
   `side_dish2_stuff` = '{$_POST['side_dish2_stuff']}' ,
   `side_dish2_cook` = '{$_POST['side_dish2_cook']}' ,
   `side_dish3` = '{$_POST['side_dish3']}' ,
   `side_dish3_stuff` = '{$_POST['side_dish3_stuff']}' ,
   `side_dish3_cook` = '{$_POST['side_dish3_cook']}' ,
   `fruit` = '{$_POST['fruit']}' ,
   `soup` = '{$_POST['soup']}' ,
   `soup_stuff` = '{$_POST['soup_stuff']}' ,
   `soup_cook` = '{$_POST['soup_cook']}' ,
   `protein` = '{$_POST['protein']}' ,
   `fat` = '{$_POST['fat']}' ,
   `carbohydrate` = '{$_POST['carbohydrate']}' ,
   `calorie` = '{$_POST['calorie']}'
  where `lunch_data_sn` = '$lunch_data_sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);

    $TadUpFiles->set_col('lunch_data_sn', $lunch_data_sn);
    $desc = sprintf(_MD_TADLUNCH2_PIC_DESC, $_POST['lunch_date']);
    $TadUpFiles->upload_file('lunch', 1024, 400, null, $desc, true);

    return $lunch_data_sn;
}

//列出所有tad_lunch2_data資料
function list_tad_lunch2_data($show_ym = '', $target = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin, $isManager, $xoopsModuleConfig;
    $now_Ym = date('Y-m');
    $nowYm = empty($show_ym) ? $now_Ym : $show_ym;

    $sql = 'SELECT left(`lunch_date`,7) AS dd FROM `' . $xoopsDB->prefix('tad_lunch2_data') . '` GROUP BY left(`lunch_date`,7) ORDER BY dd DESC';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $all_options = [];
    $i = 0;

    //$all_options[0]['ym']=$now_Ym;
    //$all_options[0]['ym_title']=str_replace("-", _MD_TADLUNCH2_Y, $now_Ym)._MD_TADLUNCH2_M;

    //$i=1;
    while (list($dd) = $xoopsDB->fetchRow($result)) {
        //if($now_Ym==$dd)continue;
        $all_options[$i]['ym'] = $dd;
        $all_options[$i]['ym_title'] = str_replace('-', _MD_TADLUNCH2_Y, $dd) . _MD_TADLUNCH2_M;
        $i++;
    }

    $xoopsTpl->assign('nowYm', $nowYm);
    $xoopsTpl->assign('all_options', $all_options);

    //$lunch_target=str_replace(";" , ",", $xoopsModuleConfig['lunch_target']);
    $lunch_target_arr = explode(';', $xoopsModuleConfig['lunch_target']);

    if ('' == $target) {
        $lunch_target = $lunch_target_arr[0];
    } else {
        $lunch_target = $target;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where lunch_date like '{$nowYm}-%' and lunch_target='{$lunch_target}' order by lunch_date";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $all_content = [];
    $i = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $lunch_data_sn ,$lunch_target, $lunch_sn , $lunch_date , $main_food , $main_food_stuff , $main_dish , $main_dish_stuff , $main_dish_cook , $side_dish1 , $side_dish1_stuff , $side_dish1_cook , $side_dish2 , $side_dish2_stuff , $side_dish2_cook , $side_dish3 , $side_dish3_stuff , $side_dish3_cook , $fruit , $soup , $soup_stuff , $soup_cook , $protein , $fat , $carbohydrate , $calorie
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $all_content[$i]['lunch_data_sn'] = $lunch_data_sn;
        $all_content[$i]['lunch_target'] = $lunch_target;
        $all_content[$i]['lunch_sn'] = $lunch_sn;
        $all_content[$i]['lunch_date'] = $lunch_date;
        $all_content[$i]['main_food'] = $main_food;
        $all_content[$i]['main_food_stuff'] = $main_food_stuff;
        $all_content[$i]['main_dish'] = $main_dish;
        $all_content[$i]['main_dish_stuff'] = $main_dish_stuff;
        $all_content[$i]['main_dish_cook'] = $main_dish_cook;
        $all_content[$i]['side_dish1'] = $side_dish1;
        $all_content[$i]['side_dish1_stuff'] = $side_dish1_stuff;
        $all_content[$i]['side_dish1_cook'] = $side_dish1_cook;
        $all_content[$i]['side_dish2'] = $side_dish2;
        $all_content[$i]['side_dish2_stuff'] = $side_dish2_stuff;
        $all_content[$i]['side_dish2_cook'] = $side_dish2_cook;
        $all_content[$i]['side_dish3'] = $side_dish3;
        $all_content[$i]['side_dish3_stuff'] = $side_dish3_stuff;
        $all_content[$i]['side_dish3_cook'] = $side_dish3_cook;
        $all_content[$i]['fruit'] = $fruit;
        $all_content[$i]['soup'] = $soup;
        $all_content[$i]['soup_stuff'] = $soup_stuff;
        $all_content[$i]['soup_cook'] = $soup_cook;
        $all_content[$i]['protein'] = $protein;
        $all_content[$i]['fat'] = $fat;
        $all_content[$i]['carbohydrate'] = $carbohydrate;
        $all_content[$i]['calorie'] = $calorie;
        $all_content[$i]['title'] = sprintf(_MD_TAD_LUNCH2_DATA_SHORT_MENU, $lunch_target);
        $i++;
    }

    //刪除確認的JS

    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('now_op', 'list_tad_lunch2_data');
    $xoopsTpl->assign('lunch_target', $lunch_target);

    $target_arr = [];
    $i = 0;
    foreach ($lunch_target_arr as $target) {
        $target_arr[$i]['title'] = trim($target);
        $i++;
    }
    $xoopsTpl->assign('lunch_target_arr', $target_arr);

    $FancyBox = new FancyBox('.lunch_fancy');
    $FancyBox->render(false);
    //加在連結中：class="edit_dropdown" rel="group"（圖） data-fancybox-type="iframe"（HTML）
}

//以流水號取得某筆tad_lunch2_data資料
function get_tad_lunch2_data($lunch_data_sn = '')
{
    global $xoopsDB;
    if (empty($lunch_data_sn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where `lunch_data_sn` = '{$lunch_data_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//刪除tad_lunch2_data某筆資料資料
function delete_tad_lunch2_data($lunch_data_sn = '')
{
    global $xoopsDB, $isAdmin, $isManager;
    $sql = 'delete from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where `lunch_data_sn` = '{$lunch_data_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql);
}

//以流水號秀出某筆tad_lunch2_data資料內容
function show_one_tad_lunch2_data($lunch_data_sn = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin, $isManager;

    if (empty($lunch_data_sn)) {
        return;
    }

    $all_data = [];

    $sql = 'select a.*,b.* from `' . $xoopsDB->prefix('tad_lunch2_data') . '` as a left join `' . $xoopsDB->prefix('tad_lunch2') . "` as b on a.lunch_sn=b.lunch_sn where a.`lunch_data_sn` = '{$lunch_data_sn}' ";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $i = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $lunch_data_sn , $lunch_sn , $lunch_date , $main_food , $main_food_stuff , $main_dish , $main_dish_stuff , $main_dish_cook , $side_dish1 , $side_dish1_stuff , $side_dish1_cook , $side_dish2 , $side_dish2_stuff , $side_dish2_cook , $side_dish3 , $side_dish3_stuff , $side_dish3_cook , $fruit , $soup , $soup_stuff , $soup_cook , $protein , $fat , $carbohydrate , $calorie

        $all['main_food_stuff'] = change_stuff($all['main_food_stuff']);
        $all['main_dish_stuff'] = change_stuff($all['main_dish_stuff']);
        $all['side_dish1_stuff'] = change_stuff($all['side_dish1_stuff']);
        $all['side_dish2_stuff'] = change_stuff($all['side_dish2_stuff']);
        $all['side_dish3_stuff'] = change_stuff($all['main_food_stuff']);
        $all['soup_stuff'] = change_stuff($all['soup_stuff']);

        $all_data[$i] = $all;
        $xoopsTpl->assign('title', sprintf(_MD_TAD_LUNCH2_DATA_MENU, $all['lunch_date'], $all['lunch_target']));
        $i++;
    }

    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('now_op', 'show_one_tad_lunch2_data');
}

function change_stuff($stuff)
{
    $stuff = str_replace(';', '<br>', $stuff);
    $stuff = str_replace('g ', 'g<br>', $stuff);

    return $stuff;
}

//取得tad_lunch2所有資料陣列
function get_tad_lunch2_all()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_lunch2') . '`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);
    $data_arr = [];
    $i = 0;
    while ($data = $xoopsDB->fetchArray($result)) {
        $data_arr[$i] = $data;
        $i++;
    }

    return $data_arr;
}

//匯入 excel
//function import_excel($lunch_sn="",$lunch_target="",$file=""){
function import_excel($lunch_sn = '', $lunch_target = '', $file = '', $file_name = '')
{
    global $xoopsDB, $xoopsTpl;
    if (empty($file) or empty($file)) {
        return;
    }

    $myts = \MyTextSanitizer::getInstance();

    include_once XOOPS_ROOT_PATH . '/modules/tadtools/PHPExcel/IOFactory.php';
    if (preg_match('/\.(xlsx)$/i', $file_name)) {
        $reader = PHPExcel_IOFactory::createReader('Excel2007');
    } else {
        $reader = PHPExcel_IOFactory::createReader('Excel5');
    }
    $PHPExcel = $reader->load($file); // 檔案名稱
    $sheet = $PHPExcel->getSheet(0); // 讀取第一個工作表(編號從 0 開始)
    $highestRow = $sheet->getHighestRow(); // 取得總列數

    $main = '';

    // 一次讀取一列
    for ($row = 1; $row <= $highestRow; $row++) {
        $all = '';
        $continue = false;
        $isTitle = false;
        for ($column = 0; $column <= 25; $column++) {
            if ((0 == $column) and PHPExcel_Shared_Date::isDateTime($sheet->getCellByColumnAndRow($column, $row))) {
                $v = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                if (0 == $column and empty($v)) {
                    break;
                }

                $val = PHPExcel_Shared_Date::ExcelToPHPObject($v)->format('Y/m/d');
            } else {
                $val = $sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
            }

            if (0 == $column and _MD_TADLUNCH2_LUNCH_DATE == $val) {
                $isTitle = true;
            } elseif (0 == $column and !preg_match('/^\d{4}[-\/]\d{1,2}[-\/]\d{1,2}$/u', $val)) {
                $continue = true;
            }
            $val = $myts->addSlashes($val);

            if ($column >= 8 and $column <= 14) {
                $show_txt = str_replace(';', '<br>', $val);
            } else {
                $show_txt = $val;
            }

            $all .= $isTitle ? "
            <th style='font-size:0.78em;'>{$show_txt}</th>
            " : "
            <td style='font-size:0.78em;'>{$show_txt}
            <input type='hidden' name='c[{$row}][$column]' value='{$val}' class='span12'>
            </td>
            ";
        }

        if ($continue) {
            continue;
        }

        $main .= "<tr>{$all}</tr>";
    }

    $xoopsTpl->assign('lunch_target', $lunch_target);
    $xoopsTpl->assign('lunch_sn', $lunch_sn);
    $xoopsTpl->assign('now_op', 'import_excel');
    $xoopsTpl->assign('main', $main);
}

//匯入資料庫
function import2DB($lunch_sn = '', $lunch_target = '')
{
    global $xoopsDB;

    $myts = \MyTextSanitizer::getInstance();
    foreach ($_POST['c'] as $row => $col) {
        foreach ($col as $i => $val) {
            $col[$i] = $myts->addSlashes($val);
        }

        //0日期  lunch_date
        //1主食  main_food
        //8主食食材（請用 ; 隔開） main_food_stuff
        //2主菜  main_dish
        //9主菜食材（請用 ; 隔開） main_dish_stuff
        //16主菜烹煮方式  main_dish_cook
        //3副菜1 side_dish1
        //10副菜1食材（請用 ; 隔開）  side_dish1_stuff
        //17副菜1烹煮方式 side_dish1_cook
        //4副菜2 side_dish2
        //11副菜2食材（請用 ; 隔開）  side_dish2_stuff
        //18副菜2烹煮方式 side_dish2_cook
        //5副菜3 side_dish3
        //12副菜3食材（請用 ; 隔開）  side_dish3_stuff
        //19副菜3烹煮方式 side_dish3_cook
        //6水果  fruit
        //7湯點  soup
        //14湯點食材（請用 ; 隔開） soup_stuff
        //21湯點烹煮方式  soup_cook
        //22蛋白質 protein
        //23脂肪  fat
        //24醣類  carbohydrate
        //25總熱量  calorie

        $col[22] = (int) $col[22];
        $col[23] = (int) $col[23];
        $col[24] = (int) $col[24];
        $col[25] = (int) $col[25];
        $sql = 'replace into ' . $xoopsDB->prefix('tad_lunch2_data') . " (`lunch_target`, `lunch_sn`, `lunch_date`, `main_food`, `main_food_stuff`, `main_dish`, `main_dish_stuff`, `main_dish_cook`, `side_dish1`, `side_dish1_stuff`, `side_dish1_cook`, `side_dish2`, `side_dish2_stuff`, `side_dish2_cook`, `side_dish3`, `side_dish3_stuff`, `side_dish3_cook`, `fruit`, `soup`, `soup_stuff`, `soup_cook`, `protein`, `fat`, `carbohydrate`, `calorie`) values('{$lunch_target}','{$lunch_sn}','{$col[0]}','{$col[1]}','{$col[8]}','{$col[2]}','{$col[9]}','{$col[16]}','{$col[3]}','{$col[10]}','{$col[17]}','{$col[4]}','{$col[11]}','{$col[18]}','{$col[5]}','{$col[12]}','{$col[19]}','{$col[6]}','{$col[7]}','{$col[14]}','{$col[21]}','{$col[22]}','{$col[23]}','{$col[24]}','{$col[25]}')";

        $xoopsDB->queryF($sql) or Utility::web_error($sql);
    }

    redirect_header($_SERVER['PHP_SELF'], 3, _MD_TAD_LUNCH2_DATA_IMPORT_OK);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$lunch_sn = system_CleanVars($_REQUEST, 'lunch_sn', 0, 'int');
$lunch_data_sn = system_CleanVars($_REQUEST, 'lunch_data_sn', 0, 'int');

$myts = \MyTextSanitizer::getInstance();
$ym = (!empty($_REQUEST['ym']) and 7 == mb_strlen($_REQUEST['ym'])) ? $myts->htmlSpecialChars($_REQUEST['ym']) : '';
$target = (!empty($_REQUEST['lunch_target'])) ? $myts->htmlSpecialChars($_REQUEST['lunch_target']) : '';

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //替換資料
    case 'replace_tad_lunch2_data':
        replace_tad_lunch2_data();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //新增資料
    case 'insert_tad_lunch2_data':
        $lunch_data_sn = insert_tad_lunch2_data();
        header("location: {$_SERVER['PHP_SELF']}?lunch_data_sn=$lunch_data_sn");
        exit;

    //更新資料
    case 'update_tad_lunch2_data':
        update_tad_lunch2_data($lunch_data_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //輸入表格
    case 'tad_lunch2_data_form':
        tad_lunch2_data_form($lunch_data_sn);
        break;

    //刪除資料
    case 'delete_tad_lunch2_data':
        delete_tad_lunch2_data($lunch_data_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case 'import_excel':
        import_excel($lunch_sn, $target, $_FILES['importfile']['tmp_name'], $_FILES['importfile']['name']); //加入檔名
        break;

    case 'import2DB':
        import2DB($lunch_sn, $target);
        break;

    case 'update_pic':
        $TadUpFiles->set_col('lunch_data_sn', $lunch_data_sn);
        $desc = sprintf(_MD_TADLUNCH2_PIC_DESC, $_POST['lunch_date']);
        $TadUpFiles->upload_file('lunch', 1024, 400, null, $desc, true);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        if (empty($lunch_data_sn)) {
            list_tad_lunch2_data($ym, $target);
        } else {
            show_one_tad_lunch2_data($lunch_data_sn);
        }
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('jquery', Utility::get_jquery(true));
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('isManager', $isManager);
include_once XOOPS_ROOT_PATH . '/footer.php';
