<?php
class Valida {

    //===============SAIDA=DE=DADOS=====================================\\

  public static function escape_html($text){
    return htmlspecialchars($text);
  }

  public static function remover_caracteres_especiais($string)  {
    $string = iconv( "UTF-8" , "ASCII//TRANSLIT//IGNORE" , $string );
    $string = preg_replace( array( '/[ ]/' , '/[^A-Za-z0-9]/' ) , array( '' , '' ) , $string );
    return $string;
  }


  //===============ENTRADA=DE=DADOS=====================================\\



  public static function texto($texto, $tag, $max=45, $min=1, $obrigatorio=true) {
    $texto = trim(strip_tags(utf8_encode($texto)));
    if ($texto || $obrigatorio) {
      if (empty($texto) && $obrigatorio):
        throw new Exception($tag.": é obrigatório.");
      elseif(strlen($texto) < $min && $obrigatorio):
          throw new Exception($tag.": deve conter no mínimo $min caracteres.");
      elseif(strlen($texto) < $min):
        throw new Exception($tag.": deve conter no mínimo $min caracteres ou deixe vazio.");
      elseif(strlen($texto) > $max && $obrigatorio):
        throw new Exception($tag.": deve conter no máximo $max caracteres.");
      elseif(strlen($texto) > $max):
        throw new Exception($tag.": deve conter no máximo $max caracteres ou deixe vazio.");
      endif;
    }
    return $texto;
  }

  public static function numero($numero, $tag, $max=10, $min=1, $obrigatorio=true) {
    $numero = self::texto($numero, $tag, $max, $min, $obrigatorio);
    if ($numero || $obrigatorio) {
      if (!preg_match('/^[0-9]*$/', $numero))
        throw new Exception($tag.": deve conter somente números.");
    }
    return $numero;
  }

  public static function registro($registro, $tag, $max=20, $min=1, $obrigatorio=true) {
    $registro = self::texto($registro, $tag, $max=20, $min=1, $obrigatorio);
    if ($registro || $obrigatorio) {
      if (!preg_match('/^[0-9\/\-\.]*$/', $registro))
        throw new Exception($tag.": deve conter somente números , barra(/), traço(-) ou ponto(.)");
    }
    return $registro;
  }

  public static function email($email, $tag, $max=100, $min=5, $obrigatorio=true)  {
    $email = self::texto($email, $tag, $max, $min, $obrigatorio);
    if ($email || $obrigatorio) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
        throw new Exception($tag.": inválido.");
      elseif(!checkdnsrr(explode('@',$email)[1],'A')):
        throw new Exception($tag.": inexistente.");
      endif;
    }
    return $email;
  }

  public static function celular($celular, $tag, $obrigatorio=true){
    $celular = self::texto($celular, $tag, 16, 8, $obrigatorio);
    if ($celular || $obrigatorio) {
      if (!preg_match('/^\(?\d{2}\)? ?9? ?\d{4}-?\d{4}$/', $celular))
        throw new Exception($tag.": número inválido.");
    }
    return $celular;
  }

  public static function data_nascimento($data, $tag, $obrigatorio=true) {
    $data = self::texto($data, $tag, 10, 8, $obrigatorio);
    if ($data || $obrigatorio) {
      $data_temp = preg_replace('/[^0-9]/', '', (string) $data);
      $dia = substr($data_temp, 0, 2);
      $mes = substr($data_temp, 2, 2);
      $ano = substr($data_temp, 4, 4);
      if ($dia < 1 || $dia > 31)
        throw new Exception($tag.": dia inválido, deve conter números de 1 a 31.");
      if ($mes < 1 || $mes > 12)
        throw new Exception($tag.": mês inválido, deve conter números de 1 a 12.");
      if ($ano < 1900)
        throw new Exception($tag.": ano inválido, deve conter anos a partir de 1900.");
    }
    return $data;
  }

  public static function cpf($cpf, $tag, $obrigatorio=true) {
    $cpf = self::texto($cpf, $tag, 14, 11, $obrigatorio);
    $cpf_original = $cpf;
    if ($cpf || $obrigatorio) {
      $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
      // Valida tamanho
      if (strlen($cpf) != 11) throw new Exception($tag.": inválido.");
      //verificar se está entre esses cpf invalidos
      $invalidos = array('00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999');
      if (in_array($cpf, $invalidos)) throw new Exception($tag.": inválido.");
      // Calcula e confere primeiro dígito verificador
      for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
      $resto = $soma % 11;
      if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        throw new Exception($tag.": inválido.");
      // Calcula e confere segundo dígito verificador
      for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
      $resto = $soma % 11;
      if ($cpf{10} != ($resto < 2 ? 0 : 11 - $resto))
        throw new Exception($tag.": inválido.");
    }
    return $cpf_original;
  }


  public static function cnpj($cnpj, $tag, $obrigatorio=true) {
    $cnpj = self::texto($cnpj, $tag, 18, 14, $obrigatorio);
    $cnpj_original = $cnpj;
    if ($cnpj || $obrigatorio) {
    	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
      $invalidos = ['00000000000000','11111111111111','22222222222222','33333333333333',	'44444444444444','55555555555555','66666666666666','77777777777777','88888888888888',    	'99999999999999' ];
      // Verifica se o CNPJ está na lista de inválidos
      if (in_array($cnpj, $invalidos))  throw new Exception($tag.": inválido.");
    	if (strlen($cnpj) != 14)	throw new Exception($tag.": inválido.");
    	// Valida primeiro dígito verificador
    	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)	{
    		$soma += $cnpj{$i} * $j;
    		$j = ($j == 2) ? 9 : $j - 1;
    	}
    	$resto = $soma % 11;
    	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))	throw new Exception($tag.": inválido.");
    	// Valida segundo dígito verificador
    	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)	{
    		$soma += $cnpj{$i} * $j;
    		$j = ($j == 2) ? 9 : $j - 1;
    	}
    	$resto = $soma % 11;
    	$valid =  ($cnpj{13} == ($resto < 2 ? 0 : 11 - $resto));
      if (!$valid) throw new Exception($tag.": inválido.");
    }
    return $cnpj_original;
  }

  public static function inteiro($numero, $tag, $type="int", $obrigatorio=true) {
    $numero = self::texto($numero, $tag, 20, 1, $obrigatorio);
    if ($numero || $obrigatorio) {
      if (!preg_match('/^[0-9]+$/', $numero)){
        throw new Exception($tag.": deve conter somente números");
      }
      switch ($type) {
        case 'byte':
          if ($numero < -128 || $numero > 127)
            throw new Exception($tag.": deve conter números de -128 a 127.");
          break;
        case 'short':
          if ($numero < -32768 || $numero > 32767)
            throw new Exception($tag.": deve conter números de -32768 a 32767.");
          break;
        case 'int':
          if ($numero < -2147483648 || $numero > 2147483647)
            throw new Exception($tag.": deve conter números de -2147483648 a 2147483647.");
          break;
        case 'long':
          if ($numero < -9223372036854775808 || $numero > 9223372036854775807)
            throw new Exception($tag.": deve conter números de -9223372036854775808 a 9223372036854775807.");
          break;
        case 'ubyte':
          if ($numero < 0 || $numero > 255)
            throw new Exception($tag.": deve conter números de 0 a 255.");
          break;
        case 'ushort':
          if ($numero < 0 || $numero > 65535)
            throw new Exception($tag.": deve conter números de 0 a 65535.");
          break;
        case 'uint':
          if ($numero < 0 || $numero > 4294967295)
            throw new Exception($tag.": deve conter números de 0 a 4294967295."); break;
        case 'ulong':
          if ($numero < 0 || $numero > 18446744073709551615)
            throw new Exception($tag.": deve conter números de 0 a 18446744073709551615.");
          break;
        default:
          throw new Exception($tag.": Parametro type do método Valida::inteiro() está incoerente.");
          break;
      }
    }
    return $numero;
  }


}
