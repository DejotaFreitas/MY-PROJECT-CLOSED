<?php
class Crypt {

  // $encrypted_txt = crypt('encrypt', 'texto');
  // $decrypted_txt = crypt('decrypt', $encrypted_txt);

  function crypt($action, $string) {
      $output = false;
      $encrypt_method = "AES-256-CBC";
      $secret_key = 'minhapalavrachave';
      $secret_iv = 'minhasecretaiv';
      // hash
      $key = hash('sha256', $secret_key);
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      if ($action == 'encrypt') {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
      } else if($action == 'decrypt') {
          $output = base64_decode($string);
          $output = openssl_decrypt($output, $encrypt_method, $key, 0, $iv);
      }
      return $output;
  }


}
