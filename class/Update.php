<?php

namespace XoopsModules\Tad_lunch2;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{

    //刪除錯誤的重複欄位及樣板檔
    public static function chk_tad_lunch2_block()
    {
        global $xoopsDB;
        //die(var_export($xoopsConfig));
        include XOOPS_ROOT_PATH . '/modules/tad_lunch2/xoops_version.php';

        //先找出該有的區塊以及對應樣板
        foreach ($modversion['blocks'] as $i => $block) {
            $show_func = $block['show_func'];
            $tpl_file_arr[$show_func] = $block['template'];
            $tpl_desc_arr[$show_func] = $block['description'];
        }

        //找出目前所有的樣板檔
        $sql = 'SELECT bid,name,visible,show_func,template FROM ' . $xoopsDB->prefix('newblocks') . "
        WHERE `dirname` = 'tad_lunch2' ORDER BY `func_num`";
        $result = $xoopsDB->query($sql);
        while (list($bid, $name, $visible, $show_func, $template) = $xoopsDB->fetchRow($result)) {
            //假如現有的區塊和樣板對不上就刪掉
            if ($template != $tpl_file_arr[$show_func]) {
                $sql = 'delete from ' . $xoopsDB->prefix('newblocks') . " where bid='{$bid}'";
                $xoopsDB->queryF($sql);

                //連同樣板以及樣板實體檔案也要刪掉
                $sql = 'delete from ' . $xoopsDB->prefix('tplfile') . ' as a
                left join ' . $xoopsDB->prefix('tplsource') . "  as b on a.tpl_id=b.tpl_id
                where a.tpl_refid='$bid' and a.tpl_module='tad_lunch2' and a.tpl_type='block'";
                $xoopsDB->queryF($sql);
            } else {
                $sql = 'update ' . $xoopsDB->prefix('tplfile') . "
                set tpl_file='{$template}' , tpl_desc='{$tpl_desc_arr[$show_func]}'
                where tpl_refid='{$bid}'";
                $xoopsDB->queryF($sql);
            }
        }
    }

    public static function chk_chk1()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tad_lunch2_files_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return false;
        }

        return true;
    }

    public static function go_update1()
    {
        global $xoopsDB;
        $sql = 'CREATE TABLE ' . $xoopsDB->prefix('tad_lunch2_files_center') . " (
        `files_sn` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
        `col_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '欄位名稱',
        `col_sn` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '欄位編號',
        `sort` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
        `kind` ENUM('img','file') NOT NULL DEFAULT 'img' COMMENT '檔案種類',
        `file_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '檔案名稱',
        `file_type` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '檔案類型',
        `file_size` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '檔案大小',
        `description` TEXT NOT NULL COMMENT '檔案說明',
        `counter` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '下載人次',
        `original_filename` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '檔案名稱',
        `hash_filename` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '加密檔案名稱',
        `sub_dir` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '檔案子路徑',
        PRIMARY KEY (`files_sn`)
        ) ENGINE=MyISAM";
        $xoopsDB->queryF($sql);
    }

    public static function chk_chk2()
    {
        global $xoopsDB;
        $sql = 'SHOW INDEX FROM `' . $xoopsDB->prefix('tad_lunch2_data') . "` where Key_name='date_target'";
        $result = $xoopsDB->query($sql);
        $num = $xoopsDB->getAffectedRows();
        if (empty($num)) {
            return false;
        }

        return true;
    }

    public static function go_update2()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_lunch2_data') . '` ADD UNIQUE `date_target` ( `lunch_target` , `lunch_date` ) ';
        $xoopsDB->queryF($sql);
    }
}
