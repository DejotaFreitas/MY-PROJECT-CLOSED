<?php
class Data {

  //converte data sempre para formato do banco yyyy-mm-dd
  public static function data_db($data) {
    if (strpos($data, '/') !== false) {
      $data_db = explode("/",$data);
      if (strlen($data_db[0])>2) {  return implode("-", $data_db); }
      else { return implode("-",array_reverse($data_db)); }
    } elseif (strpos($data, '-') !== false) {
      $data_db = explode("-", $data);
      if (strlen($data_db[0])>2) {  return implode("-", $data_db); }
      else { return implode("-",array_reverse($data_db)); }
    }
  }

  // converte data sempre para formato brazileiro dd/mm/yyyy
  public static function data_br($data) {
    if (strpos($data, '/') !== false) {
      $data_db = explode("/",$data);
      if (strlen($data_db[0])>2) {  return implode("/",array_reverse($data_db)); }
      else { return implode("/", $data_db); }
    } elseif (strpos($data, '-') !== false) {
      $data_db = explode("-", $data);
      if (strlen($data_db[0])>2) { return implode("/",array_reverse($data_db));  }
      else { return implode("/", $data_db); }
    }
  }

  public static function data_hora_db($data) {
    $data_time = explode(" ", $data);
    $data_temp = self::data_db($data_time[0]);
    return $data_temp." ".$data_time[1];
  }

  public static function data_hora_br($data) {
    $data_time = explode(" ", $data);
    $data_temp = self::data_br($data_time[0]);
    return $data_temp." ".$data_time[1];
  }


}
