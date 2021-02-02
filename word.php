<?php
use XoopsModules\Tadtools\Utility;
include_once 'header.php';

include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$ym = system_CleanVars($_REQUEST, 'ym', '', 'string');

$myts = \MyTextSanitizer::getInstance();
if (!empty($ym)) {
    list($year, $month) = explode('-', $ym);
    $month = sprintf('%02s', $month);
} else {
    $year = date('Y');
    $month = date('m');
}
$lunch_target = $myts->addSlashes($_GET['lunch_target']);
$title = sprintf(_MD_TADLUNCH2_YM, $year, $month) . $lunch_target . _MD_TADLUNCH2_SMNAME1;

require_once XOOPS_ROOT_PATH . '/modules/tadtools/PHPWord.php';
$PHPWord = new PHPWord();
$PHPWord->setDefaultFontSize(9); //設定預設字型大小
$sectionStyle = ['orientation' => 'portrait', 'marginTop' => 900, 'marginLeft' => 900, 'marginRight' => 900, 'marginBottom' => 900];

$section = $PHPWord->createSection($sectionStyle);

$fontStyle = ['color' => '000000', 'size' => 16, 'bold' => true];
$PHPWord->addTitleStyle(1, $fontStyle);
$section->addTitle($title, 1);
$contentfontStyle = ['color' => '000000', 'size' => 9, 'bold' => false];

$styleTable = ['borderColor' => '000000', 'borderSize' => 6, 'cellMargin' => 50];
$styleFirstRow = ['bgColor' => 'CFCFCF']; //首行樣式
$PHPWord->addTableStyle('myTable', $styleTable, $styleFirstRow); //建立表格樣式
$table = $section->addTable('myTable'); //建立表格

$cellStyle = ['valign' => 'center']; //儲存格樣式（設定項：valign、textDirection、bgColor、borderTopSize、borderTopColor、borderLeftSize、borderLeftColor、borderRightSize、borderRightColor、borderBottomSize、borderBottomColor）
$paraStyle = ['align' => 'center'];
$headStyle = ['bold' => true, 'align' => 'center'];

$table->addRow(); //新增一列
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_LUNCH_DATE, null, $headStyle);
$table->addCell(700, $cellStyle)->addText(_MD_TADLUNCH2_WEEK, null, $headStyle); //新增一格
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_MDIN_FOOD, null, $headStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_MDIN_DISH, null, $headStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_SIDE_DISH1, null, $headStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_SIDE_DISH2, null, $headStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_SIDE_DISH3, null, $headStyle);
$table->addCell(1000, $cellStyle)->addText(_MD_TADLUNCH2_FRUIT, null, $headStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADLUNCH2_SOUP, null, $headStyle);
$table->addCell(1000, $cellStyle)->addText(_MD_TADLUNCH2_CALORIE, null, $headStyle);

$and_lunch_target = empty($lunch_target) ? '' : "and lunch_target='{$lunch_target}'";
$sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where lunch_date like '{$year}-{$month}-%' $and_lunch_target order by `lunch_date`,`lunch_target`";

$result = $xoopsDB->query($sql) or Utility::web_error($sql);

$cw = [_MD_TADLUNCH2_SU, _MD_TADLUNCH2_MO, _MD_TADLUNCH2_TU, _MD_TADLUNCH2_WE, _MD_TADLUNCH2_TH, _MD_TADLUNCH2_FR, _MD_TADLUNCH2_SA];
$i = 2;
while ($all = $xoopsDB->fetchArray($result)) {
    //以下會產生這些變數： `lunch_data_sn`, `lunch_target`, `lunch_sn`, `lunch_date`, `main_food`, `main_food_stuff`, `main_dish`, `main_dish_stuff`, `main_dish_cook`, `side_dish1`, `side_dish1_stuff`, `side_dish1_cook`, `side_dish2`, `side_dish2_stuff`, `side_dish2_cook`, `side_dish3`, `side_dish3_stuff`, `side_dish3_cook`, `fruit`, `soup`, `soup_stuff`, `soup_cook`, `protein`, `fat`, `carbohydrate`, `calorie`
    foreach ($all as $k => $v) {
        $$k = $v;
    }
    $w = date('w', strtotime($lunch_date));

    //  日 期 星期  主 食 副食 一  副食 二  副食 三  湯 水果  熱量(大卡 )

    $table->addRow(); //新增一列
    $table->addCell(1500, $cellStyle)->addText($lunch_date, null, $paraStyle);
    $table->addCell(700, $cellStyle)->addText($cw[$w], null, $paraStyle); //新增一格
    $table->addCell(1500, $cellStyle)->addText($main_food, null, $paraStyle);
    $table->addCell(1500, $cellStyle)->addText($main_dish, null, $paraStyle);
    $table->addCell(1500, $cellStyle)->addText($side_dish1, null, $paraStyle);
    $table->addCell(1500, $cellStyle)->addText($side_dish2, null, $paraStyle);
    $table->addCell(1500, $cellStyle)->addText($side_dish3, null, $paraStyle);
    $table->addCell(1000, $cellStyle)->addText($fruit, null, $paraStyle);
    $table->addCell(1500, $cellStyle)->addText($soup, null, $paraStyle);
    $table->addCell(1000, $cellStyle)->addText($calorie, null, $paraStyle);
}

$title = (_CHARSET === 'UTF-8') ? iconv('UTF-8', 'Big5', $title) : $title;
header('Content-Type: application/vnd.ms-word');
header("Content-Disposition: attachment;filename={$title}.docx");
header('Cache-Control: max-age=0');
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('php://output');
