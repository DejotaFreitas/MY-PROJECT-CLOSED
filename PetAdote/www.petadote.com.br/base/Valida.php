<?php
class Valida {

  public static function limpar($value){
    return trim(strip_tags($value));
  }

  public static function limpar_utf8($value){
    return trim(strip_tags(utf8_encode($value)));
  }

  public static function texto($texto, $max=45, $min=1, $obrigatorio=true) {
    if ($texto || $obrigatorio) {
      if (empty($texto) && $obrigatorio):
        throw new Exception("campo obrigatório.");
      elseif(mb_strlen($texto) < $min && $obrigatorio):
          throw new Exception("deve conter no mínimo $min caracteres.");
      elseif(mb_strlen($texto) < $min && !empty($texto) && !$obrigatorio):
        throw new Exception("deve conter no mínimo $min caracteres ou nenhum.");
      elseif(mb_strlen($texto) > $max && $obrigatorio):
        throw new Exception("deve conter no máximo $max caracteres.");
      elseif(mb_strlen($texto) > $max && !$obrigatorio):
        throw new Exception("deve conter no máximo $max caracteres ou nenhum.");
      endif;
    }
    return $texto;
  }

  public static function numero($numero, $max=10, $min=1, $obrigatorio=true) {
    $numero = self::texto($numero, $max, $min, $obrigatorio);
    if ($numero || $obrigatorio) {
      if (!preg_match('/^[0-9]*$/', $numero))
        throw new Exception("deve conter somente números.");
    }
    return $numero;
  }

  public static function decimal($valor, $max=20, $min=1, $obrigatorio=true) {
    $valor = self::texto($valor, $max, $min, $obrigatorio);
    if ($valor || $obrigatorio) {
      if (!preg_match('/^[0-9]+/', $valor))
        throw new Exception("deve iniciar com números.");
      if (!preg_match('/[0-9]+$/', $valor))
        throw new Exception("deve terminar com números.");
      $valor_temp = str_replace(',', '.', $valor);
      $valores = explode('.', $valor_temp);
      if (count($valores)> 2)
        throw new Exception("deve conter apenas uma vírgula ou ponto.");
  }
    return $valor;
  }

  public static function dinheiro($valor, $max=10, $min=1, $obrigatorio=true) {
    $valor = self::texto($valor, $max, $min, $obrigatorio);
    if ($valor || $obrigatorio) {
      if (!preg_match('/^[0-9]+/', $valor))
        throw new Exception("deve iniciar com números.");
      if (!preg_match('/[0-9]+$/', $valor))
        throw new Exception("deve terminar com números.");
      $valor_temp = str_replace(',', '.', $valor);
      $valores = explode('.', $valor_temp);
      if (count($valores)> 2)
        throw new Exception("deve conter apenas uma vírgula ou ponto.");
      if(count($valores) == 2 && strlen($valores[1]) > 2)
        throw new Exception("deve conter no máximo, duas casas decimais.");
  }
    return $valor;
  }

  public static function registro($registro, $max=20, $min=1, $obrigatorio=true) {
    $registro = self::texto($registro, $max=20, $min=1, $obrigatorio);
    if ($registro || $obrigatorio) {
      if (!preg_match('/^[0-9\/\-\.]*$/', $registro))
        throw new Exception("deve conter somente números, barra(/), traço(-) ou ponto(.)");
    }
    return $registro;
  }

  public static function email($email, $max=100, $min=5, $obrigatorio=true)  {
    $email = self::texto($email, $max, $min, $obrigatorio);
    if ($email || $obrigatorio) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
        throw new Exception("e-mail inválido.");
      // elseif(!checkdnsrr(explode('@',$email)[1],'A')):
      //   throw new Exception("inexistente.");
      endif;
    }
    return $email;
  }

  public static function celular($celular, $obrigatorio=true){
    $celular = self::texto($celular, 16, 8, $obrigatorio);
    if ($celular || $obrigatorio) {
      if (!preg_match('/^\(?\d{2}\)? ?9? ?\d{4}-?\d{4}$/', $celular))
        throw new Exception("número inválido.");
    }
    return $celular;
  }

  public static function data_nascimento($data, $obrigatorio=true) {
    $data = self::texto($data, 10, 8, $obrigatorio);
    if ($data || $obrigatorio) {
      $data_temp = preg_replace('/[^0-9]/', '', (string) $data);
      $dia = substr($data_temp, 0, 2);
      $mes = substr($data_temp, 2, 2);
      $ano = substr($data_temp, 4, 4);
      if ($dia < 1 || $dia > 31)
        throw new Exception("dia inválido, deve conter números de 1 a 31.");
      if ($mes < 1 || $mes > 12)
        throw new Exception("mês inválido, deve conter números de 1 a 12.");
      if ($ano < 1900)
        throw new Exception("ano inválido, deve conter anos a partir de 1900.");
    }
    return $data;
  }

  public static function cpf($cpf, $obrigatorio=true) {
    $cpf = self::texto($cpf, 14, 11, $obrigatorio);
    $cpf_original = $cpf;
    if ($cpf || $obrigatorio) {
      $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
      // Valida tamanho
      if (strlen($cpf) != 11) throw new Exception("inválido.");
      //verificar se está entre esses cpf invalidos
      $invalidos = array('00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999');
      if (in_array($cpf, $invalidos)) throw new Exception("cpf inválido.");
      // Calcula e confere primeiro dígito verificador
      for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
      $resto = $soma % 11;
      if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        throw new Exception("cpf inválido.");
      // Calcula e confere segundo dígito verificador
      for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
      $resto = $soma % 11;
      if ($cpf{10} != ($resto < 2 ? 0 : 11 - $resto))
        throw new Exception("cpf inválido.");
    }
    return $cpf_original;
  }


  public static function cnpj($cnpj, $obrigatorio=true) {
    $cnpj = self::texto($cnpj, 18, 14, $obrigatorio);
    $cnpj_original = $cnpj;
    if ($cnpj || $obrigatorio) {
    	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
      if (strlen($cnpj) == 0 && $obrigatorio)  throw new Exception("cnpj inválido.");
      $invalidos = ['00000000000000','11111111111111','22222222222222','33333333333333',	'44444444444444','55555555555555','66666666666666','77777777777777','88888888888888',    	'99999999999999' ];
      // Verifica se o CNPJ está na lista de inválidos
      if (in_array($cnpj, $invalidos))  throw new Exception("cnpj inválido.");
    	if (strlen($cnpj) != 14)	throw new Exception("cnpj inválido.");
    	// Valida primeiro dígito verificador
    	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)	{
    		$soma += $cnpj{$i} * $j;
    		$j = ($j == 2) ? 9 : $j - 1;
    	}
    	$resto = $soma % 11;
    	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))	throw new Exception("cnpj inválido.");
    	// Valida segundo dígito verificador
    	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)	{
    		$soma += $cnpj{$i} * $j;
    		$j = ($j == 2) ? 9 : $j - 1;
    	}
    	$resto = $soma % 11;
    	$valid =  ($cnpj{13} == ($resto < 2 ? 0 : 11 - $resto));
      if (!$valid) throw new Exception("cnpj inválido.");
    }
    return $cnpj_original;
  }


}
