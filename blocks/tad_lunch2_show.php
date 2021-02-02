<?php
use XoopsModules\Tadtools\FancyBox;

if (!class_exists('XoopsModules\Tadtools\FancyBox')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
//區塊主函式 (營養午餐公告(tad_lunch2_show))
function tad_lunch2_show($options)
{
    global $xoopsDB;

    $modhandler = xoops_getHandler('module');
    $xoopsModule = $modhandler->getByDirname('tad_lunch2');
    $config_handler = xoops_getHandler('config');
    $xoopsModuleConfig = &$config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));

    $today = date('Y-m-d');
    $cw = explode(';', _MB_TADLUNCH2_WEEKS);

    $lunch_target = str_replace(';', ',', $xoopsModuleConfig['lunch_target']);
    $tarr = explode(',', $lunch_target);

    $i = 0;
    $lunchs = [];
    //for($n=0;$n<$options[0];$n++){
    foreach ($tarr as $target) {
        for ($n = 0; $n < $options[0]; $n++) {
            $today = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $n, date('Y')));

            $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where lunch_date = '{$today}' and lunch_target='{$target}' order by lunch_date ";
            //die($sql);
            $result = $xoopsDB->query($sql);
            $total = $xoopsDB->getRowsNum($result);
            if (empty($total)) {
                $sql = 'select * from `' . $xoopsDB->prefix('tad_lunch2_data') . "` where  lunch_date >= '{$today}' and main_food <>'' and  lunch_target='{$target}'   order by lunch_date limit 0,{$options[0]}";
                $result = $xoopsDB->query($sql);
            }
            $all_content = [];
            while ($all = $xoopsDB->fetchArray($result)) {
                //以下會產生這些變數： $lunch_data_sn ,$lunch_target, $lunch_sn , $lunch_date , $main_food , $main_food_stuff , $main_dish , $main_dish_stuff , $main_dish_cook , $side_dish1 , $side_dish1_stuff , $side_dish1_cook , $side_dish2 , $side_dish2_stuff , $side_dish2_cook , $side_dish3 , $side_dish3_stuff , $side_dish3_cook , $fruit , $soup , $soup_stuff , $soup_cook , $protein , $fat , $carbohydrate , $calorie
                foreach ($all as $k => $v) {
                    $$k = $v;
                }
                $w = date('w', strtotime($lunch_date));

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
                $all_content[$i]['title'] = sprintf(_MB_TAD_LUNCH2_DATA_SHORT_MENU, $lunch_target);
                $all_content[$i]['w'] = $cw[$w];
                $i++;
            }
            $lunchs[$n] = $all_content;
        }
    }
    //刪除確認的JS
    $block['content'] = $lunchs;
    $block['type'] = empty($options[1]) ? 'horizontal' : $options[1];
    if (empty($options[2])) {
        $options[2] = ['main_food', 'main_dish', 'side_dish1', 'side_dish2', 'side_dish3', 'fruit', 'soup', 'calorie'];
    }
    $block['show_cols'] = explode(',', $options[2]);

    $FancyBox = new FancyBox('.lunch_block_fancy', '1280', 'auto');
    $FancyBox->render(false);

    return $block;
}

//區塊編輯函式
function tad_lunch2_show_edit($options)
{
    $modhandler = xoops_getHandler('module');
    $xoopsModule = $modhandler->getByDirname('tad_lunch2');
    $config_handler = xoops_getHandler('config');
    $xoopsModuleConfig = $config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));

    $seled0_0 = ('1' == $options[0]) ? 'selected' : '';
    $seled0_1 = ('2' == $options[0]) ? 'selected' : '';
    $seled0_2 = ('3' == $options[0]) ? 'selected' : '';
    $seled0_3 = ('4' == $options[0]) ? 'selected' : '';
    $seled0_4 = ('5' == $options[0]) ? 'selected' : '';
    $seled0_5 = ('6' == $options[0]) ? 'selected' : '';
    $seled0_6 = ('7' == $options[0]) ? 'selected' : '';

    $horizontal = ('horizontal' === $options[1]) ? 'checked' : '';
    $vertical = ('vertical' === $options[1]) ? 'checked' : '';

    if (empty($options[2])) {
        $options[2] = 'main_food,main_dish,side_dish1,side_dish2,side_dish3,fruit,soup,calorie';
    }

    $sc = explode(',', $options[2]);
    $main_food = in_array('main_food', $sc) ? 'checked' : '';
    $main_dish = in_array('main_dish', $sc) ? 'checked' : '';
    $side_dish1 = in_array('side_dish1', $sc) ? 'checked' : '';
    $side_dish2 = in_array('side_dish2', $sc) ? 'checked' : '';
    $side_dish3 = in_array('side_dish3', $sc) ? 'checked' : '';
    $fruit = in_array('fruit', $sc) ? 'checked' : '';
    $soup = in_array('soup', $sc) ? 'checked' : '';
    $calorie = in_array('calorie', $sc) ? 'checked' : '';
    if (empty($xoopsModuleConfig['use_cols'])) {
        $main_food_use = $main_dish_use = $side_dish1_use = $side_dish2_use = $side_dish3_use = $fruit_use = $soup_use = $calorie_use = '';
    } else {
        $main_food_use = in_array('main_food', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $main_dish_use = in_array('main_dish', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $side_dish1_use = in_array('side_dish1', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $side_dish2_use = in_array('side_dish2', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $side_dish3_use = in_array('side_dish3', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $fruit_use = in_array('fruit', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $soup_use = in_array('soup', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
        $calorie_use = in_array('calorie', $xoopsModuleConfig['use_cols']) ? '' : "style='text-decoration:line-through;color:red;'";
    }
    $form = "
  <script>
  function bbv(){
    i=0;
    var arr = new Array();
    if(document.getElementById('main_food').checked){
      arr[i] = document.getElementById('main_food').value;
      i++;
    }
    if(document.getElementById('main_dish').checked){
      arr[i] = document.getElementById('main_dish').value;
      i++;
    }
    if(document.getElementById('side_dish1').checked){
      arr[i] = document.getElementById('side_dish1').value;
      i++;
    }
    if(document.getElementById('side_dish2').checked){
      arr[i] = document.getElementById('side_dish2').value;
      i++;
    }
    if(document.getElementById('side_dish3').checked){
      arr[i] = document.getElementById('side_dish3').value;
      i++;
    }
    if(document.getElementById('fruit').checked){
      arr[i] = document.getElementById('fruit').value;
      i++;
    }
    if(document.getElementById('soup').checked){
      arr[i] = document.getElementById('soup').value;
      i++;
    }
    if(document.getElementById('calorie').checked){
      arr[i] = document.getElementById('calorie').value;
      i++;
    }
    document.getElementById('show_cols').value=arr.join(',');
  }
  </script>
  <div>
    " . _MB_TADLUNCH2_TAD_LUNCH2_SHOW_EDIT_BITEM0 . "
    <select name='options[0]'>
      <option $seled0_0 value='1'>1</option>
      <option $seled0_1 value='2'>2</option>
      <option $seled0_2 value='3'>3</option>
      <option $seled0_3 value='4'>4</option>
      <option $seled0_4 value='5'>5</option>
      <option $seled0_5 value='6'>6</option>
      <option $seled0_6 value='7'>7</option>
    </select>
  </div>
  <div>
    " . _MB_TADLUNCH2_BLOCK_SHOW_MODE . "
    <input type='radio' name='options[1]' id='horizontal' value='horizontal' $horizontal>
    <label for='horizontal'>" . _MB_TADLUNCH2_BLOCK_SHOW_H . "</label>

    <input type='radio' name='options[1]' id='vertical' value='vertical' $vertical>
    <label for='vertical'>" . _MB_TADLUNCH2_BLOCK_SHOW_V . '</label>
  </div>
  <div>
    ' . _MB_TADLUNCH2_BLOCK_SHOW_COLS . "
    <input type='checkbox' name='options[2]' id='main_food' value='main_food' $main_food onChange=bbv()>
    <label for='main_food' $main_food_use>" . _MB_TADLUNCH2_MAIN_FOOD . "</label>

    <input type='checkbox' name='options[2]' id='main_dish' value='main_dish' $main_dish onChange=bbv()>
    <label for='main_dish' $main_dish_use>" . _MB_TADLUNCH2_MAIN_DISH . "</label>

    <input type='checkbox' name='options[2]' id='side_dish1' value='side_dish1' $side_dish1 onChange=bbv()>
    <label for='side_dish1' $side_dish1_use>" . _MB_TADLUNCH2_SIDE_DISH1 . "</label>

    <input type='checkbox' name='options[2]' id='side_dish2' value='side_dish2' $side_dish2 onChange=bbv()>
    <label for='side_dish2' $side_dish2_use>" . _MB_TADLUNCH2_SIDE_DISH2 . "</label>

    <input type='checkbox' name='options[2]' id='side_dish3' value='side_dish3' $side_dish3 onChange=bbv()>
    <label for='side_dish3' $side_dish3_use>" . _MB_TADLUNCH2_SIDE_DISH3 . "</label>

    <input type='checkbox' name='options[2]' id='fruit' value='fruit' $fruit onChange=bbv()>
    <label for='fruit' $fruit_use>" . _MB_TADLUNCH2_FRUIT . "</label>

    <input type='checkbox' name='options[2]' id='soup' value='soup' $soup onChange=bbv()>
    <label for='soup' $soup_use>" . _MB_TADLUNCH2_SOUP . "</label>

    <input type='checkbox' name='options[2]' id='calorie' value='calorie' $calorie onChange=bbv()>
    <label for='calorie' $calorie_use>" . _MB_TADLUNCH2_CALORIE . "</label>


    <INPUT type='hidden' name='options[2]' id='show_cols' value='{$options[2]}'>
  </div>
  ";

    return $form;
}
