<?php
if (SessaoUsuario::logado()) {
  $id_pet = json_decode($_POST['json'], true);
  $id_pet = $id_pet['id_pet'];
  $id_usuario = SessaoUsuario::usuario()['id'];
  try {
      $seu_pet = CRUD::select('pet p INNER JOIN relacao r ON p.id = r.pet_id', 'p.foto_facial, p.foto_lateral, p.foto_superior', 'r.usuario_id=? AND r.pet_id=? AND (relacao=? OR relacao=? OR relacao=?)', [$id_usuario, $id_pet, 'Doação', 'Perdido', 'Encontrado']);
      if (!empty($seu_pet)) {
        $img_src1 = $seu_pet[0]['foto_facial'];
        $img_src2 = $seu_pet[0]['foto_lateral'];
        $img_src3 = $seu_pet[0]['foto_superior'];
        CRUD::beginTransaction();
        CRUD::delete('relacao', 'pet_id = ?', [$id_pet]);
        CRUD::delete('pet', 'id = ?', [$id_pet]);
        CRUD::commit();
        if (file_exists(DIRETORIO_RAIZ.$img_src1))
        unlink(DIRETORIO_RAIZ.$img_src1);
        if (file_exists(DIRETORIO_RAIZ.$img_src2))
          unlink(DIRETORIO_RAIZ.$img_src2);
        if (file_exists(DIRETORIO_RAIZ.$img_src3))
          unlink(DIRETORIO_RAIZ.$img_src3);
        echo "deletado";
      }
  } catch (Exception $e) {
    CRUD::rollBack();
  }
}
