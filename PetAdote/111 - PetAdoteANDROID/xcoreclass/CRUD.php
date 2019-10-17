<?php
class CRUD {

  private $conexao;

  public function __construct() {
    if(!isset($this->conexao)){
      try {
        try {
          $this->conexao = new PDO("mysql:dbname=".DATABASE."; host=".HOST."; charset=utf8", USER, PASS);
          $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
          $this->conexao = new PDO("mysql:dbname=".DATABASE_TESTE."; host=".HOST_TESTE."; charset=utf8", USER_TESTE, PASS_TESTE);
          $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
      } catch (PDOException $e) {
        throw new Exception("CONEXAO: ".$e->getMessage());
        exit;
      }
    }
  }

  public function last_id(){
    return $this->conexao->lastInsertId();
  }

  //==============================INSERT==============================\\

  public function insert($tabela, $array_campos_valores) {
    $campos = implode(',', array_keys($array_campos_valores));
    $size = count($array_campos_valores);
    $valores = array_values($array_campos_valores);
    $interrogacoes = substr(str_repeat("?,", $size), 0, $size*2-1);
    $sql = $this->conexao->prepare("INSERT INTO $tabela ($campos) VALUES ($interrogacoes);");
    $sql->execute($valores);
  }

  //==============================UPDATE==============================\\

  public function update($tabela, $array_campos_valores,  $where, $parametros=[]) {
    $campos = implode(' = ? , ', array_keys($array_campos_valores));
    $campos = $campos. ' = ? ';
    $valores = array_values($array_campos_valores);
    $valores =  array_merge($valores, $parametros);
    $sql = $this->conexao->prepare("UPDATE $tabela SET $campos WHERE $where;");
    $sql->execute($valores);
  }

  //==============================DELETE==============================\\

  public function delete($tabela, $where, $parametros=[]){
    $sql = $this->conexao->prepare("DELETE FROM $tabela WHERE $where;");
    $sql->execute($parametros);
  }

  //==============================SELECT GENERICO==============================\\

  public function select($tabelas, $campos='*', $where='', $parametros=[]) {
    $sql = $this->conexao->prepare("SELECT $campos FROM $tabelas".($where==''?'':" WHERE ".$where).";");
    $sql->execute($parametros);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectQuery($query, $parametros=[]) {
    $sql = $this->conexao->prepare($query);
    $sql->execute($parametros);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //==============================TRANSACAO==============================\\

  public function beginTransaction() {
    $this->conexao->beginTransaction();
  }

  public function commit() {
      $this->conexao->commit();
  }

  public function rollBack(){
    $this->conexao->rollBack();
  }


} //============FIM DA CLASSE============\\



//======================SELECT ESCROTO======================//
// public static function select_animal_pesquisa_limit($especie, $estado, $cidade, $ini, $qnt) {
//   $sql = $this->conexao->prepare(
//     "SELECT a.id, a.foto, a.nome FROM animal a, usuario u WHERE a.status = 0 AND a.usuario_id = u.id AND a.especie LIKE ? AND u.estado LIKE ? AND u.cidade LIKE ? LIMIT $ini, $qnt;"
//   );
//   $sql->execute(["%".$especie."%", "%".$estado."%", "%".$cidade."%"]);
//   return $sql->fetchAll(PDO::FETCH_ASSOC);
// }

//======================TRANSAÇÃO======================//
// public static function update_adocao_confirmada($id_pet, $id_adotante) {
//   $pdo = $this->conexao;
//   $pdo->beginTransaction();
//
//   $sql = $pdo->prepare("UPDATE adocao SET status = ? WHERE animal_id = ? AND usuario_id = ?;");
//   if (!$sql->execute(["Aceito", $id_pet, $id_adotante])) { throw new Exception("Erro na confirmacão da adoção.");  }
//
//   $sql = $pdo->prepare("UPDATE animal SET status = ? WHERE id = ?;");
//   if (!$sql->execute([1 ,$id_pet])) { $pdo->rollBack();  throw new Exception("Erro na confirmacão da adoção."); }
//
//   $sql = $pdo->prepare("UPDATE adocao SET status = ? WHERE animal_id = ? AND usuario_id <> ?;");
//   if (!$sql->execute(["Rejeitado", $id_pet, $id_adotante])) { $pdo->rollBack();  throw new Exception("Erro na confirmacão da adoção.");  }
//
//   return $pdo->commit();
// }
