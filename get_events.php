<?php
use XoopsModules\Tadtools\Utility;
include_once 'header.php';

$start = date('Y-m-d', $_REQUEST['start'] / 1000);
$end = date('Y-m-d', $_REQUEST['end'] / 1000);

$lunch_target_arr = explode(';', $xoopsModuleConfig['lunch_target']);
if (empty($_REQUEST['lunch_target'])) {
    $lunch_target = trim($lunch_target_arr[0]);
} else {
    $lunch_target = trim($_REQUEST['lunch_target']);
}

$sql = 'select  * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where lunch_date >= '$start' and lunch_date <= '$end' and lunch_target='{$lunch_target}'";
$result = $xoopsDB->query($sql) or Utility::web_error($sql);

$myEvents = [];
$i = 0;

if (empty($xoopsModuleConfig['use_cols'])) {
    $show_main_food = $show_main_dish = $show_side_dish1 = $show_side_dish2 = $show_side_dish3 = $show_fruit = $show_soup = true;
} else {
    $show_main_food = in_array('main_food', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_main_dish = in_array('main_dish', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_side_dish1 = in_array('side_dish1', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_side_dish2 = in_array('side_dish2', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_side_dish3 = in_array('side_dish3', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_fruit = in_array('fruit', $xoopsModuleConfig['use_cols']) ? true : false;
    $show_soup = in_array('soup', $xoopsModuleConfig['use_cols']) ? true : false;
}

if ('1' == $xoopsModuleConfig['show_kind']) {
    $main_food_for = _MD_TADLUNCH2_MDIN_FOOD . _TAD_FOR;
    $main_dish_for = _MD_TADLUNCH2_MDIN_DISH . _TAD_FOR;
    $side_dish1_for = _MD_TADLUNCH2_SIDE_DISH1 . _TAD_FOR;
    $side_dish2_for = _MD_TADLUNCH2_SIDE_DISH2 . _TAD_FOR;
    $side_dish3_for = _MD_TADLUNCH2_SIDE_DISH3 . _TAD_FOR;
    $fruit_for = _MD_TADLUNCH2_FRUIT . _TAD_FOR;
    $soup_for = _MD_TADLUNCH2_SOUP . _TAD_FOR;
} else {
    $main_food_for = $main_dish_for = $side_dish1_for = $side_dish2_for = $side_dish3_for = $fruit_for = $soup_for = '';
}

while ($all = $xoopsDB->fetchArray($result)) {
    //以下會產生這些變數： $lunch_data_sn ,$lunch_target, $lunch_sn , $lunch_date , $main_food , $main_food_stuff , $main_dish , $main_dish_stuff , $main_dish_cook , $side_dish1 , $side_dish1_stuff , $side_dish1_cook , $side_dish2 , $side_dish2_stuff , $side_dish2_cook , $side_dish3 , $side_dish3_stuff , $side_dish3_cook , $fruit , $soup , $soup_stuff , $soup_cook , $protein , $fat , $carbohydrate , $calorie
    foreach ($all as $k => $v) {
        $$k = $v;
    }
    $name = '';
    if (!empty($main_food) and $show_main_food) {
        $name .= $main_food_for . $main_food . "\n";
    }

    if (!empty($main_dish) and $show_main_dish) {
        $name .= $main_dish_for . $main_dish . "\n";
    }

    if (!empty($side_dish1) and $show_side_dish1) {
        $name .= $side_dish1_for . $side_dish1 . "\n";
    }

    if (!empty($side_dish2) and $show_side_dish2) {
        $name .= $side_dish2_for . $side_dish2 . "\n";
    }

    if (!empty($side_dish3) and $show_side_dish3) {
        $name .= $side_dish3_for . $side_dish3 . "\n";
    }

    if (!empty($fruit) and $show_fruit) {
        $name .= $fruit_for . $fruit . "\n";
    }

    if (!empty($soup) and $show_soup) {
        $name .= $soup_for . $soup . "\n";
    }

    $myEvents[$i]['id'] = $lunch_data_sn;
    $myEvents[$i]['title'] = $name;
    $myEvents[$i]['start'] = strtotime($lunch_date);
    $myEvents[$i]['rel'] = XOOPS_URL . '/modules/tad_lunch2/lunch.php?lunch_data_sn=' . $lunch_data_sn;
    $myEvents[$i]['className'] = 'lunch_fancy fancybox.ajax';
    $i++;
}

echo json_encode($myEvents);
