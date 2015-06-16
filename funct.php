<?php

function POST($key, $default = "") {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
function GET($key, $default = "") {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}
function SanitizeBooleanVar($inp){
  if(strtolower($inp) == "yes")
  {
    $inp = 1;
  }elseif(strtolower($inp) == "no"){
    $inp = 0;
  }else{
    $inp = 2;
  }
  return $inp;
}
?>
