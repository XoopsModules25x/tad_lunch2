<?php
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
include 'header.php';
include_once XOOPS_ROOT_PATH . '/header.php';

/*-----------功能函數區--------------*/

//以流水號秀出某筆tad_lunch2_data資料內容
function show_one_tad_lunch2_data($lunch_data_sn = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin, $isManager, $xoopsModuleConfig;

    if (empty($lunch_data_sn)) {
        return;
    }
    $TadUpFiles = new TadUpFiles('tad_lunch2');

    //上傳表單name, 是否縮圖, 顯示模式 (filename、small), 顯示描述, 顯示下載次數, 數量限制, 自訂路徑, 加密, 自動播放時間(0 or 3000)
    //show_files($upname="",$thumb=true,$show_mode="",$show_description=false,$show_dl=false,$limit=NULL,$path=NULL,$hash=false,$playSpeed=5000)
    //

    $bootstrap = Utility::get_bootstrap('return');
    $jquery = Utility::get_jquery('return');

    $all_data = "{$bootstrap}{$jquery}";

    $sql = 'select a.*,b.* from `' . $xoopsDB->prefix('tad_lunch2_data') . '` as a left join `' . $xoopsDB->prefix('tad_lunch2') . "` as b on a.lunch_sn=b.lunch_sn where a.`lunch_data_sn` = '{$lunch_data_sn}' ";
    // die($sql);
    $result = $xoopsDB->query($sql) or Utility::web_error($sql);

    $all = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $lunch_data_sn , $lunch_sn , $lunch_date , $main_food , $main_food_stuff , $main_dish , $main_dish_stuff , $main_dish_cook , $side_dish1 , $side_dish1_stuff , $side_dish1_cook , $side_dish2 , $side_dish2_stuff , $side_dish2_cook , $side_dish3 , $side_dish3_stuff , $side_dish3_cook , $fruit , $soup , $soup_stuff , $soup_cook , $protein , $fat , $carbohydrate , $calorie
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    $TadUpFiles->set_col('lunch_data_sn', $lunch_data_sn);
    $show_files = $TadUpFiles->get_pic_file('thumb'); //thumb 小圖, images 大圖（default）, file 檔案
    if ($show_files) {
        $show_files = "<img src='$show_files' alt='$lunch_date' title='$lunch_date lunch' style='max-width: 100%;'>";
    } else {
        $show_files = '';
    }

    $desc = sprintf(_MD_TADLUNCH2_PIC_DESC, $_POST['lunch_date']);

    $upform = $TadUpFiles->upform(false, 'lunch', 1, false);

    $main_food_stuff = change_stuff($main_food_stuff);
    $main_dish_stuff = change_stuff($main_dish_stuff);
    $side_dish1_stuff = change_stuff($side_dish1_stuff);
    $side_dish2_stuff = change_stuff($side_dish2_stuff);
    $side_dish3_stuff = change_stuff($main_food_stuff);
    $soup_stuff = change_stuff($soup_stuff);

    $title = sprintf(_MD_TAD_LUNCH2_DATA_MENU, $lunch_date, $lunch_target);

    $tool = '';
    if ($isAdmin or $isManager) {
        $tool = "
            <script type='text/javascript'>
              function delete_tad_lunch2_data_func(lunch_data_sn){
                var sure = window.confirm('" . _TAD_DEL_CONFIRM . "');
                if (!sure)  return;
                location.href='" . XOOPS_URL . "/modules/tad_lunch2/index.php?op=delete_tad_lunch2_data&lunch_data_sn=' + lunch_data_sn;
              }
            </script>
            <div class='row'>
              <form action='" . XOOPS_URL . "/modules/tad_lunch2/index.php' method='post' id='myForm' enctype='multipart/form-data'>
                <div class='col-sm-7'>
                  $upform
                </div>

                <div class='col-sm-5 text-right'>
                  <input type='hidden' name='lunch_date' value='{$lunch_date}'>
                  <input type='hidden' name='lunch_data_sn' value='{$lunch_data_sn}'>
                  <input type='hidden' name='op' value='update_pic'>
                  <button type='submit' class='btn btn-xs btn-primary'>" . _TAD_SAVE . "</button>

                  <a href='javascript:delete_tad_lunch2_data_func($lunch_data_sn)' class='btn btn-xs btn-danger'>" . _TAD_DEL . "</a>
                  <a href='" . XOOPS_URL . "/modules/tad_lunch2/index.php?op=tad_lunch2_data_form&lunch_data_sn={$lunch_data_sn}' class='btn btn-xs btn-warning'>" . _TAD_EDIT . "</a>
                  <a href='" . XOOPS_URL . "/modules/tad_lunch2/index.php?op=tad_lunch2_data_form' class='btn btn-xs btn-info'>" . _TAD_ADD . '</a>
                </div>

              </form>
            </div>';
    }

    $show_protein = $show_fat = $show_carbohydrate = $show_calorie = '';
    if ($protein) {
        $show_protein = "
            <div class='col-sm-3'>
              <span class='label label-success'>" . _MD_TADLUNCH2_PROTEIN . "</span>
              {$protein} g
            </div>";
    }

    if ($fat) {
        $show_fat = "
            <div class='col-sm-3'>
              <span class='label label-warning'>" . _MD_TADLUNCH2_FAT . "</span>
              {$fat} g
            </div>";
    }

    if ($carbohydrate) {
        $show_carbohydrate = "
            <div class='col-sm-3'>
              <span class='label label-danger'>" . _MD_TADLUNCH2_CARBOHYDRATE . "</span>
              {$carbohydrate} g
            </div>";
    }

    if ($calorie) {
        $show_calorie = "
            <div class='col-sm-3'>
              <span class='label label-info'>" . _MD_TADLUNCH2_CALORIE . "</span>
              {$calorie} g
            </div>";
    }

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
    if ($show_main_food) {
        $main_food_title = "
            <th id='main_food' style='text-align:center;'><!--主食-->
              <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/main_food.png' alt='" . _MD_TADLUNCH2_MDIN_FOOD . "'>" . _MD_TADLUNCH2_MDIN_FOOD . '
            </th>';

        $main_food_content = "
              <td headers='main_food' style='text-align:center;'>$main_food</td>
            ";

        $main_food_s = "
              <td headers='main_food' style='text-align:center;'>$main_food_stuff</td>
            ";

        $main_food_c = "
              <td headers='main_food' style='text-align:center;'>$main_food_cook</td>
            ";
    }

    if ($show_main_dish) {
        $main_dish_title = "
              <th id='main_dish' style='text-align:center;'><!--主菜-->
              <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/main_dish.png' alt='" . _MD_TADLUNCH2_MDIN_DISH . "'>" . _MD_TADLUNCH2_MDIN_DISH . '
              </th>';

        $main_dish_content = "
              <td headers='main_dish' style='text-align:center;'>$main_dish</td>
            ";

        $main_dish_s = "
              <td headers='main_dish' style='text-align:center;'>$main_dish_stuff</td>
            ";

        $main_dish_c = "
              <td headers='main_dish' style='text-align:center;'>$main_dish_cook</td>
            ";
    }

    if ($show_side_dish1) {
        $side_dish1_title = "
             <th id='side_dish1' style='text-align:center;'><!--副菜1-->
             <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/side_dish1.png' alt='" . _MD_TADLUNCH2_SIDE_DISH1 . "'>" . _MD_TADLUNCH2_SIDE_DISH1 . '
             </th>';

        $side_dish1_content = "
              <td headers='side_dish1' style='text-align:center;'>$side_dish1</td>
            ";

        $side_dish1_s = "
              <td headers='side_dish1' style='text-align:center;'>$side_dish1_stuff</td>
            ";

        $side_dish1_c = "
              <td headers='side_dish1' style='text-align:center;'>$side_dish1_cook</td>
            ";
    }

    if ($show_side_dish2) {
        $side_dish2_title = "
             <th id='side_dish2' style='text-align:center;'><!--副菜2-->
             <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/side_dish2.png' alt='" . _MD_TADLUNCH2_SIDE_DISH2 . "'>" . _MD_TADLUNCH2_SIDE_DISH2 . '
             </th>';

        $side_dish2_content = "
              <td headers='side_dish2' style='text-align:center;'>$side_dish2</td>
            ";

        $side_dish2_s = "
              <td headers='side_dish2' style='text-align:center;'>$side_dish2_stuff</td>
            ";

        $side_dish2_c = "
              <td headers='side_dish2' style='text-align:center;'>$side_dish2_cook</td>
            ";
    }

    if ($show_side_dish3) {
        $side_dish3_title = "
             <th id='side_dish3' style='text-align:center;'><!--副菜3-->
             <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/side_dish3.png' alt='" . _MD_TADLUNCH2_SIDE_DISH3 . "'>" . _MD_TADLUNCH2_SIDE_DISH3 . '
             </th>';

        $side_dish3_content = "
              <td headers='side_dish3' style='text-align:center;'>$side_dish3</td>
            ";

        $side_dish3_s = "
              <td headers='side_dish3' style='text-align:center;'>$side_dish3_stuff</td>
            ";

        $side_dish3_c = "
              <td headers='side_dish3' style='text-align:center;'>$side_dish3_cook</td>
            ";
    }

    if ($show_fruit) {
        $fruit_title = "
            <th id='fruit' style='text-align:center;'><!--水果-->
            <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/fruit.png' alt='" . _MD_TADLUNCH2_FRUIT . "'>" . _MD_TADLUNCH2_FRUIT . '
            </th>';

        $fruit_content = "
              <td headers='fruit' style='text-align:center;'>$fruit</td>
            ";

        $fruit_s = "
              <td headers='fruit' style='text-align:center;'></td>
            ";

        $fruit_c = "
              <td headers='fruit' style='text-align:center;'></td>
            ";
    }

    if ($show_soup) {
        $soup_title = "
            <th id='soup' style='text-align:center;'><!--湯點-->
            <img src='" . XOOPS_URL . "/modules/tad_lunch2/images/soup.png' alt='" . _MD_TADLUNCH2_MDIN_FOOD . "'>" . _MD_TADLUNCH2_SOUP . '
            </th>';

        $soup_content = "
              <td headers='soup' style='text-align:center;'>$soup</td>
            ";

        $soup_s = "
              <td headers='soup' style='text-align:center;'>$soup_stuff</td>
            ";

        $soup_c = "
              <td headers='soup' style='text-align:center;'>$soup_cook</td>
            ";
    }

    $main_data = "
    <table class='table table-striped table-bordered table-hover'>

      <tr>
        <th id='store' style='text-align:center;'><!--廠商--></th>
        $main_food_title
        $main_dish_title
        $side_dish1_title
        $side_dish2_title
        $side_dish3_title
        $fruit_title
        $soup_title
      </tr>
      <tr>
        <th headers='store' style='text-align:center;'>" . _MD_TADLUNCH2_FOOD . "</th>
        $main_food_content
        $main_dish_content
        $side_dish1_content
        $side_dish2_content
        $side_dish3_content
        $fruit_content
        $soup_content
      </tr>
      <tr>
        <th headers='store' style='text-align:center;'>" . _MD_TADLUNCH2_FOOD_STUFF_SHORT . "</th>
        $main_food_s
        $main_dish_s
        $side_dish1_s
        $side_dish2_s
        $side_dish3_s
        $fruit_s
        $soup_s
      </tr>
      <tr>
        <th headers='store' style='text-align:center;'>" . _MD_TADLUNCH2_COOK_SHORT . "</th>
        $main_food_c
        $main_dish_c
        $side_dish1_c
        $side_dish2_c
        $side_dish3_c
        $fruit_c
        $soup_c
      </tr>
    </table>
    $tool";

    if ($show_files) {
        $all_data .= "
            <div class='row'>
              <div class='col-sm-4'>
                $show_files
              </div>

              <div class='col-sm-8'>
                <h2>
                 $title
                </h2>
                <div class='alert alert-info'>
                  <div class='row'>
                    $show_protein
                    $show_fat
                    $show_carbohydrate
                    $show_calorie
                  </div>
                </div>
                $main_data
              </div>
            </div>
            ";
    } else {
        $all_data .= "

            <h2>
             $title
            </h2>

            <div class='alert alert-info'>
              <div class='row'>
                $show_protein
                $show_fat
                $show_carbohydrate
                $show_calorie
              </div>
            </div>
            $main_data
            ";
    }

    $content = '<!DOCTYPE html>
<html lang="en">
<head>
  <title>' . _MD_TADLUNCH2_SMNAME1 . '</title>
</head>
<body>
<div class="container-fluid">
' . $all_data . '
</div>
</body>
</html>';
    die($content);
}

function change_stuff($stuff)
{
    $stuff = str_replace(';', '<br>', $stuff);
    $stuff = str_replace('g ', 'g<br>', $stuff);

    return $stuff;
}

/*-----------執行動作判斷區----------*/
$lunch_data_sn = empty($_REQUEST['lunch_data_sn']) ? '' : (int) $_REQUEST['lunch_data_sn'];
show_one_tad_lunch2_data($lunch_data_sn);

/*-----------秀出結果區--------------*/

include_once XOOPS_ROOT_PATH . '/footer.php';
