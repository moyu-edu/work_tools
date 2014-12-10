<?php
//自动加载类
class Eii_loader{
   public static function main($str){
      try{
          $temp = explode('\\',$str);
//          echo "<br>";
//          var_export($temp);
//          echo "<br>";
          if($temp[1] === 'ReflectionMethod'){
              return;
          }
          switch($temp[0]){
              case 'business':
                  self::businessLoadFn($temp);
                  break;
              case 'lib':
                  self::libLoadFn($temp);
                  break;
          }
      }catch(Exception $e){
          echo '出错代码'.$e->getCode().'出错行数'.$e->getLine();
      }
   }
   public static function libLoadFn($temp){
       require $temp[0].'/'.$temp[1].'.lib.php';
   }
   public static function businessLoadFn($temp){
       require $temp[0].'/'.$temp[1].'.class.php';
   }
}
spl_autoload_register("Eii_loader::main");

//全局配置
define('DB_FILE', '/tmp/test2.db');

use \business\FileDb;
use \business\DbBehavior;
$fileDb = FileDb::getInstance();
$fileDb->on('afterInsert',function($row){
   echo "Inserted (From )".__FUNCTION__.")\n";
});
$fileDb->attachBehavior('DbBehavior',new DbBehavior());
$fileDb->insert(array('sijiaomao','cat@animals.org'));
echo "The First Line is: ".$fileDb->getFirstRecord();