<?php 
// class to operate filesize

class FileUtil {
/**
    * �����ļ���
    *
    * @param string $aimUrl
    * @return viod
    */
static function createDir($aimUrl) {
       $aimUrl = str_replace('', '/', $aimUrl);
       $aimDir = '';
       $arr = explode('/', $aimUrl);
       foreach ($arr as $str) {
         $aimDir .= $str . '/';
         if (!file_exists($aimDir)) {
            mkdir($aimDir);
         }
       }
}
/**
    * �����ļ�
    *
    * @param string $aimUrl 
    * @param boolean $overWrite �ò��������Ƿ񸲸�ԭ�ļ�
    * @return boolean
    */
static function createFile($aimUrl, $overWrite = false) {
       if (file_exists($aimUrl) && $overWrite == false) {
         return false;
       } elseif (file_exists($aimUrl) && $overWrite == true) {
         FileUtil::unlinkFile($aimUrl);
       }
       $aimDir = dirname($aimUrl);
       FileUtil::createDir($aimDir);
       touch($aimUrl);
       return true;
}
/**
    * �ƶ��ļ���
    *
    * @param string $oldDir
    * @param string $aimDir
    * @param boolean $overWrite �ò��������Ƿ񸲸�ԭ�ļ�
    * @return boolean
    */
static function moveDir($oldDir, $aimDir, $overWrite = false) {
       $aimDir = str_replace('', '/', $aimDir);
       $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
       $oldDir = str_replace('', '/', $oldDir);
       $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
       if (!is_dir($oldDir)) {
         return false;
       }
       if (!file_exists($aimDir)) {
         FileUtil::createDir($aimDir);
       }
       @$dirHandle = opendir($oldDir);
       if (!$dirHandle) {
         return false;
       }
       while(false !== ($file = readdir($dirHandle))) {
         if ($file == '.' || $file == '..') {
            continue;
         }
         if (!is_dir($oldDir.$file)) {
            FileUtil::moveFile($oldDir . $file, $aimDir . $file, $overWrite);
         } else {
            FileUtil::moveDir($oldDir . $file, $aimDir . $file, $overWrite);
         }
       }
       closedir($dirHandle);
       return rmdir($oldDir);
}
/**
    * �ƶ��ļ�
    *
    * @param string $fileUrl
    * @param string $aimUrl
    * @param boolean $overWrite �ò��������Ƿ񸲸�ԭ�ļ�
    * @return boolean
    */
static function moveFile($fileUrl, $aimUrl, $overWrite = false) {
       if (!file_exists($fileUrl)) {
         return false;
       }
       if (file_exists($aimUrl) && $overWrite = false) {
         return false;
       } elseif (file_exists($aimUrl) && $overWrite = true) {
         FileUtil::unlinkFile($aimUrl);
       }
       $aimDir = dirname($aimUrl);
       FileUtil::createDir($aimDir);
       rename($fileUrl, $aimUrl);
       return true;
}
/**
    * ɾ���ļ���
    *
    * @param string $aimDir
    * @return boolean
    */
static function unlinkDir($aimDir) {
       $aimDir = str_replace('', '/', $aimDir);
       $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';
       if (!is_dir($aimDir)) {
         return false;
       }
       $dirHandle = opendir($aimDir);
       while(false !== ($file = readdir($dirHandle))) {
         if ($file == '.' || $file == '..') {
            continue;
         }
         if (!is_dir($aimDir.$file)) {
            FileUtil::unlinkFile($aimDir . $file);
         } else {
            FileUtil::unlinkDir($aimDir . $file);
         }
       }
       closedir($dirHandle);
       return rmdir($aimDir);
}
/**
    * ɾ���ļ�
    *
    * @param string $aimUrl
    * @return boolean
    */
static function unlinkFile($aimUrl) {
       if (file_exists($aimUrl)) {
         unlink($aimUrl);
         return true;
       } else {
         return false;
       }
}
/**
    * �����ļ���
    *
    * @param string $oldDir
    * @param string $aimDir
    * @param boolean $overWrite �ò��������Ƿ񸲸�ԭ�ļ�
    * @return boolean
    */
static function copyDir($oldDir, $aimDir, $overWrite = false) {
       $aimDir = str_replace('', '/', $aimDir);
       $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';
       $oldDir = str_replace('', '/', $oldDir);
       $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir.'/';
       if (!is_dir($oldDir)) {
         return false;
       }
       if (!file_exists($aimDir)) {
         FileUtil::createDir($aimDir);
       }
       $dirHandle = opendir($oldDir);
       while(false !== ($file = readdir($dirHandle))) {
         if ($file == '.' || $file == '..') {
            continue;
         }
         if (!is_dir($oldDir . $file)) {
            FileUtil::copyFile($oldDir . $file, $aimDir . $file, $overWrite);
         } else {
            FileUtil::copyDir($oldDir . $file, $aimDir . $file, $overWrite);
         }
       }
       return closedir($dirHandle);
}
/**
    * �����ļ�
    *
    * @param string $fileUrl
    * @param string $aimUrl
    * @param boolean $overWrite �ò��������Ƿ񸲸�ԭ�ļ�
    * @return boolean
    */
static function copyFile($fileUrl, $aimUrl, $overWrite = false) {
       if (!file_exists($fileUrl)) {
         return false;
       }
       if (file_exists($aimUrl) && $overWrite == false) {
         return false;
       } elseif (file_exists($aimUrl) && $overWrite == true) {
         FileUtil::unlinkFile($aimUrl);
       }
       $aimDir = dirname($aimUrl);
       FileUtil::createDir($aimDir);
       copy($fileUrl, $aimUrl);
       return true;
}
}
?>