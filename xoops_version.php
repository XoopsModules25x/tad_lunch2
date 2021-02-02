<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TADLUNCH2_NAME;
$modversion['version'] = '2.2';
$modversion['description'] = _MI_TADLUNCH2_DESC;
$modversion['author'] = _MI_TADLUNCH2_AUTHOR;
$modversion['credits'] = _MI_TADLUNCH2_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2019-05-10';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADLUNCH2_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADLUNCH2_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5.7';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TADLUNCH2_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1; //---資料表架構---//

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_lunch2';
$modversion['tables'][2] = 'tad_lunch2_data';
$modversion['tables'][3] = 'tad_lunch2_files_center';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

//---樣板設定---//
$i = 0;
$modversion['templates'][$i]['file'] = 'tad_lunch2_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_lunch2_adm_main.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_lunch2_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_lunch2_index.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_lunch2_adm_man.tpl';
$modversion['templates'][$i]['description'] = 'tad_lunch2_adm_man.tpl';

//---區塊設定---//
$i = 0;
$modversion['blocks'][$i]['file'] = 'tad_lunch2_show.php';
$modversion['blocks'][$i]['name'] = _MI_TADLUNCH2_BNAME1;
$modversion['blocks'][$i]['description'] = _MI_TADLUNCH2_BDESC1;
$modversion['blocks'][$i]['show_func'] = 'tad_lunch2_show';
$modversion['blocks'][$i]['template'] = 'tad_lunch2_block_tad_lunch2_show.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tad_lunch2_show_edit';
$modversion['blocks'][$i]['options'] = '1|horizontal|main_food,main_dish,side_dish1,side_dish2,side_dish3,fruit,soup,calorie';

//---偏好設定---//
$modversion['config'][1]['name'] = 'lunch_target';
$modversion['config'][1]['title'] = '_MI_TADLUNCH2_FOR_WHOM';
$modversion['config'][1]['description'] = '_MI_TADLUNCH2_FOR_WHOM_DESC';
$modversion['config'][1]['formtype'] = 'textbox';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = _MI_TADLUNCH2_FOR_WHOM_DEFAULT;

$modversion['config'][2]['name'] = 'lunch_manager';
$modversion['config'][2]['title'] = '_MI_TADLUNCH2_MANAGER';
$modversion['config'][2]['description'] = '_MI_TADLUNCH2_MANAGER_DESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = '1';

$modversion['config'][3]['name'] = 'use_cols';
$modversion['config'][3]['title'] = '_MI_TADLUNCH2_USE_COLS';
$modversion['config'][3]['description'] = '_MI_TADLUNCH2_USE_COLS_DESC';
$modversion['config'][3]['formtype'] = 'select_multi';
$modversion['config'][3]['valuetype'] = 'array';
$modversion['config'][3]['options'] = [_MI_TADLUNCH2_MAIN_FOOD => 'main_food', _MI_TADLUNCH2_MAIN_DISH => 'main_dish', _MI_TADLUNCH2_SIDE_DISH1 => 'side_dish1', _MI_TADLUNCH2_SIDE_DISH2 => 'side_dish2', _MI_TADLUNCH2_SIDE_DISH3 => 'side_dish3', _MI_TADLUNCH2_FRUIT => 'fruit', _MI_TADLUNCH2_SOUP => 'soup', _MI_TADLUNCH2_CALORIE => 'calorie'];
$modversion['config'][3]['default'] = ['main_food', 'main_dish', 'side_dish1', 'side_dish2', 'side_dish3', 'fruit', 'soup', 'calorie'];

$modversion['config'][4]['name'] = 'show_kind';
$modversion['config'][4]['title'] = '_MI_TADLUNCH2_SHOW_KIND';
$modversion['config'][4]['description'] = '_MI_TADLUNCH2_SHOW_KIND_DESC';
$modversion['config'][4]['formtype'] = 'yesno';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = '1';
