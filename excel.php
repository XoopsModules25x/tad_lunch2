<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
include_once 'header.php';

$myts = \MyTextSanitizer::getInstance();
if (!empty($_GET['ym'])) {
    list($year, $month) = explode('-', $_GET['ym']);
    $month = sprintf('%02s', $month);
} else {
    $year = date('Y');
    $month = date('m');
}
$lunch_target = $myts->addSlashes($_GET['lunch_target']);
$title = sprintf(_MD_TADLUNCH2_YM, $year, $month) . $lunch_target . _MD_TADLUNCH2_SMNAME1;

require_once XOOPS_ROOT_PATH . '/modules/tadtools/vendor/phpoffice/phpexcel/Classes/PHPExcel.php'; //引入 PHPExcel 物件庫
require_once XOOPS_ROOT_PATH . '/modules/tadtools/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php'; //引入PHPExcel_IOFactory 物件庫
$objPHPExcel = new PHPExcel(); //實體化Excel
//----------內容-----------//

$objPHPExcel->setActiveSheetIndex(0); //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle($title); //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改

$objActSheet->getColumnDimension('A')->setWidth(15);
$objActSheet->getColumnDimension('B')->setWidth(15);
$objActSheet->getColumnDimension('C')->setWidth(15);
$objActSheet->getColumnDimension('D')->setWidth(15);
$objActSheet->getColumnDimension('E')->setWidth(15);
$objActSheet->getColumnDimension('F')->setWidth(15);
$objActSheet->getColumnDimension('G')->setWidth(15);
$objActSheet->getColumnDimension('H')->setWidth(15);
$objActSheet->getColumnDimension('I')->setWidth(15);
$objActSheet->getColumnDimension('J')->setWidth(15);
$objActSheet->getColumnDimension('K')->setWidth(15);
$objActSheet->getColumnDimension('L')->setWidth(15);
$objActSheet->getColumnDimension('M')->setWidth(15);
$objActSheet->getColumnDimension('N')->setWidth(15);
$objActSheet->getColumnDimension('O')->setWidth(15);
$objActSheet->getColumnDimension('P')->setWidth(15);
$objActSheet->getColumnDimension('Q')->setWidth(15);
$objActSheet->getColumnDimension('R')->setWidth(15);
$objActSheet->getColumnDimension('S')->setWidth(15);
$objActSheet->getColumnDimension('T')->setWidth(15);
$objActSheet->getColumnDimension('U')->setWidth(15);
$objActSheet->getColumnDimension('V')->setWidth(15);
$objActSheet->getColumnDimension('W')->setWidth(15);
$objActSheet->getColumnDimension('X')->setWidth(15);
$objActSheet->getColumnDimension('Y')->setWidth(15);
$objActSheet->getColumnDimension('Z')->setWidth(15);

$objActSheet->getStyle('A1:Z1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC9E3F3');

//日期  主食  主菜  副菜1 副菜2 副菜3 水果  湯點  主食食材（請用 ; 隔開） 主菜食材（請用 ; 隔開） 副菜1食材（請用 ; 隔開）  副菜2食材（請用 ; 隔開）  副菜3食材（請用 ; 隔開）  水果食材（請用 ; 隔開） 湯點食材（請用 ; 隔開） 主食烹煮方式  主菜烹煮方式  副菜1烹煮方式 副菜2烹煮方式 副菜3烹煮方式 水果烹煮方式  湯點烹煮方式  蛋白質 脂肪  醣類  總熱量
$objActSheet->setCellValue('A1', _MD_TADLUNCH2_LUNCH_DATE)
    ->setCellValue('B1', _MD_TADLUNCH2_MDIN_FOOD)
    ->setCellValue('C1', _MD_TADLUNCH2_MDIN_DISH)
    ->setCellValue('D1', _MD_TADLUNCH2_SIDE_DISH1)
    ->setCellValue('E1', _MD_TADLUNCH2_SIDE_DISH2)
    ->setCellValue('F1', _MD_TADLUNCH2_SIDE_DISH3)
    ->setCellValue('G1', _MD_TADLUNCH2_FRUIT)
    ->setCellValue('H1', _MD_TADLUNCH2_SOUP)
    ->setCellValue('I1', _MD_TADLUNCH2_MDIN_FOOD_STUFF)
    ->setCellValue('J1', _MD_TADLUNCH2_MDIN_DISH_STUFF)
    ->setCellValue('K1', _MD_TADLUNCH2_SIDE_DISH1_STUFF)
    ->setCellValue('L1', _MD_TADLUNCH2_SIDE_DISH2_STUFF)
    ->setCellValue('M1', _MD_TADLUNCH2_SIDE_DISH3_STUFF)
    ->setCellValue('N1', _MD_TADLUNCH2_FRUIT_STUFF)
    ->setCellValue('O1', _MD_TADLUNCH2_SOUP_STUFF)
    ->setCellValue('P1', _MD_TADLUNCH2_MDIN_FOOD_COOK)
    ->setCellValue('Q1', _MD_TADLUNCH2_MDIN_DISH_COOK)
    ->setCellValue('R1', _MD_TADLUNCH2_SIDE_DISH1_COOK)
    ->setCellValue('S1', _MD_TADLUNCH2_SIDE_DISH2_COOK)
    ->setCellValue('T1', _MD_TADLUNCH2_SIDE_DISH3_COOK)
    ->setCellValue('U1', _MD_TADLUNCH2_FRUIT_COOK)
    ->setCellValue('V1', _MD_TADLUNCH2_SOUP_COOK)
    ->setCellValue('W1', _MD_TADLUNCH2_PROTEIN)
    ->setCellValue('X1', _MD_TADLUNCH2_FAT)
    ->setCellValue('Y1', _MD_TADLUNCH2_CARBOHYDRATE)
    ->setCellValue('Z1', _MD_TADLUNCH2_CALORIE);

$and_lunch_target = empty($lunch_target) ? '' : "and lunch_target='{$lunch_target}'";
$sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where lunch_date like '{$year}-{$month}-%' $and_lunch_target order by `lunch_date`,`lunch_target`";

$result = $xoopsDB->query($sql) or Utility::web_error($sql);

$i = 2;
while ($all = $xoopsDB->fetchArray($result)) {
    //以下會產生這些變數： `lunch_data_sn`, `lunch_target`, `lunch_sn`, `lunch_date`, `main_food`, `main_food_stuff`, `main_dish`, `main_dish_stuff`, `main_dish_cook`, `side_dish1`, `side_dish1_stuff`, `side_dish1_cook`, `side_dish2`, `side_dish2_stuff`, `side_dish2_cook`, `side_dish3`, `side_dish3_stuff`, `side_dish3_cook`, `fruit`, `soup`, `soup_stuff`, `soup_cook`, `protein`, `fat`, `carbohydrate`, `calorie`
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    //日期  主食  主菜  副菜1 副菜2 副菜3 水果  湯點  主食食材（請用 ; 隔開） 主菜食材（請用 ; 隔開） 副菜1食材（請用 ; 隔開）  副菜2食材（請用 ; 隔開）  副菜3食材（請用 ; 隔開）  水果食材（請用 ; 隔開） 湯點食材（請用 ; 隔開） 主食烹煮方式  主菜烹煮方式  副菜1烹煮方式 副菜2烹煮方式 副菜3烹煮方式 水果烹煮方式  湯點烹煮方式  蛋白質 脂肪  醣類  總熱量

    $objActSheet->setCellValue("A{$i}", $lunch_date)
        ->setCellValue("B{$i}", $main_food)
        ->setCellValue("C{$i}", $main_dish)
        ->setCellValue("D{$i}", $side_dish1)
        ->setCellValue("E{$i}", $side_dish2)
        ->setCellValue("F{$i}", $side_dish3)
        ->setCellValue("G{$i}", $fruit)
        ->setCellValue("H{$i}", $soup)
        ->setCellValue("I{$i}", $main_food_stuff)
        ->setCellValue("J{$i}", $main_dish_stuff)
        ->setCellValue("K{$i}", $side_dish1_stuff)
        ->setCellValue("L{$i}", $side_dish2_stuff)
        ->setCellValue("M{$i}", $side_dish3_stuff)
        ->setCellValue("N{$i}", '')
        ->setCellValue("O{$i}", $soup_stuff)
        ->setCellValue("P{$i}", '')
        ->setCellValue("Q{$i}", $main_dish_cook)
        ->setCellValue("R{$i}", $side_dish1_cook)
        ->setCellValue("S{$i}", $side_dish2_cook)
        ->setCellValue("T{$i}", $side_dish3_cook)
        ->setCellValue("U{$i}", '')
        ->setCellValue("V{$i}", $soup_cook)
        ->setCellValue("W{$i}", $protein)
        ->setCellValue("X{$i}", $fat)
        ->setCellValue("Y{$i}", $carbohydrate)
        ->setCellValue("Z{$i}", $calorie);
    $i++;
}

$title = (_CHARSET === 'UTF-8') ? iconv('UTF-8', 'Big5', $title) : $title;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename={$title}.xlsx");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;
