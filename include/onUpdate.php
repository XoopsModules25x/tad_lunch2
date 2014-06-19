<?php

function xoops_module_update_tad_lunch2(&$module, $old_version) {
    GLOBAL $xoopsDB;

    mk_dir(XOOPS_ROOT_PATH."/uploads/tad_lunch2");
    mk_dir(XOOPS_ROOT_PATH."/uploads/tad_lunch2/thumbs");
    if(!chk_chk1()) go_update1();

    return true;
}

function chk_chk1(){
  global $xoopsDB;
  $sql="select count(*) from ".$xoopsDB->prefix("tad_lunch2_files_center");
  $result=$xoopsDB->query($sql);
  if(empty($result)) return false;
  return true;
}


function go_update1(){
  global $xoopsDB;
  $sql="CREATE TABLE `".$xoopsDB->prefix("tad_lunch2_files_center")."` (
    `files_sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '�ɮ׬y����',
    `col_name` varchar(255) NOT NULL default '' COMMENT '���W��',
    `col_sn` smallint(5) unsigned NOT NULL default 0 COMMENT '���s��',
    `sort` smallint(5) unsigned NOT NULL default 0 COMMENT '�Ƨ�',
    `kind` enum('img','file') NOT NULL default 'img' COMMENT '�ɮ׺���',
    `file_name` varchar(255) NOT NULL default '' COMMENT '�ɮצW��',
    `file_type` varchar(255) NOT NULL default '' COMMENT '�ɮ�����',
    `file_size` int(10) unsigned NOT NULL default 0 COMMENT '�ɮפj�p',
    `description` text NOT NULL COMMENT '�ɮ׻���',
    `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '�U���H��',
    `original_filename` varchar(255) NOT NULL default '' COMMENT '�ɮצW��',
    `hash_filename` varchar(255) NOT NULL default '' COMMENT '�[�K�ɮצW��',
    `sub_dir` varchar(255) NOT NULL default '' COMMENT '�ɮפl���|',
    PRIMARY KEY (`files_sn`)
) ENGINE=MyISAM";
  $xoopsDB->queryF($sql);
}


//�إߥؿ�
function mk_dir($dir=""){
    //�Y�L�ؿ��W�٨q�Xĵ�i�T��
    if(empty($dir))return;
    //�Y�ؿ����s�b���ܫإߥؿ�
    if (!is_dir($dir)) {
        umask(000);
        //�Y�إߥ��Ѩq�Xĵ�i�T��
        mkdir($dir, 0777);
    }
}

//�����ؿ�
function full_copy( $source="", $target=""){
  if ( is_dir( $source ) ){
    @mkdir( $target );
    $d = dir( $source );
    while ( FALSE !== ( $entry = $d->read() ) ){
      if ( $entry == '.' || $entry == '..' ){
        continue;
      }

      $Entry = $source . '/' . $entry;
      if ( is_dir( $Entry ) ) {
        full_copy( $Entry, $target . '/' . $entry );
        continue;
      }
      copy( $Entry, $target . '/' . $entry );
    }
    $d->close();
  }else{
    copy( $source, $target );
  }
}


function rename_win($oldfile,$newfile) {
   if (!rename($oldfile,$newfile)) {
      if (copy ($oldfile,$newfile)) {
         unlink($oldfile);
         return TRUE;
      }
      return FALSE;
   }
   return TRUE;
}


function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

?>
