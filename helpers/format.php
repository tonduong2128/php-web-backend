<?php
/**
* Format Class
*/
class Format{
 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
 }

public function textShorten($text, $limit = 400){
   $text = $text." ";
   $text = substr($text, 0, $limit);
   $text = substr($text, 0, strrpos($text,' '));
   $text = substr_replace($text,"...",strlen($text),0);
   return $text; 
}

 public function validation($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

 public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'home';
    }elseif ($title == 'contact') {
     $title = 'contact';
    }
    return $title = ucfirst($title);
   }
   public function currency($n){
      $n = (string)$n;
      $n = strrev($n);
      $res="";
      for ($i=0; $i < strlen($n); $i++){
         if ( $i % 3 == 0 && $i != 0){
            $res.=".";
         }
         $res.=$n[$i];
      }
      $res = strrev($res);
      return $res;
   }
}
?>
