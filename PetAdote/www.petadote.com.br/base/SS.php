<?php

class SS {

  public static function s($ss, $id, $s=null) {
      if ($s === null && !empty($_SESSION[$ss][$id])) {
        $x = $_SESSION[$ss][$id];
        unset($_SESSION[$ss][$id]);
        return $x;
      }
      if ($s !== null)
        $_SESSION[$ss][$id] = $s;
  }

  public static function sss($ss, $id, $s=null) {
      if ($s === null && !empty($_SESSION[$ss][$id])) {
        $x = $_SESSION[$ss][$id];
        return $x;
      }
      if ($s !== null)
        $_SESSION[$ss][$id] = $s;
  }

  public static function empty($ss, $id=null){
    if ($id === null)
      return empty($_SESSION[$ss]);
    return empty($_SESSION[$ss][$id]);
  }

  public static function isset($ss, $id=null){
    if ($id === null)
      return isset($_SESSION[$ss]);
    return isset($_SESSION[$ss][$id]);
  }

  public static function clean($ss, $id=null){
    if ($id === null)
      unset($_SESSION[$ss]);
    else
      unset($_SESSION[$ss][$id]);
  }

}
