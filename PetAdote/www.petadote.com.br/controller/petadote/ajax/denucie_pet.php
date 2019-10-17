<?php
if (SessaoUsuario::logado()) {
  try {
    $id_pet = json_decode($_POST['json'], true);
    $id_pet = $id_pet['id_pet'];
    $usuario_id = SessaoUsuario::usuario()['id'];
    $denuncia = ['tipo'=>'pet', 'delator'=>$usuario_id, 'denunciado'=>$id_pet ];

    try {
        CRUD::beginTransaction();
        CRUD::insert('denuncia', $denuncia);
        $todas_denuncias = CRUD::select('denuncia', '*', 'tipo = ? AND denunciado  = ?', ['pet', $id_pet]);
        $deletado = (count($todas_denuncias) >= 100);
        if ($deletado) {
          $img_pets = CRUD::select('pet', 'foto_facial, foto_lateral, foto_superior', 'id  = ?', [$id_pet]);
          $img_src1 = $img_pets[0]['foto_facial'];
          $img_src2 = $img_pets[0]['foto_lateral'];
          $img_src3 = $img_pets[0]['foto_superior'];
          CRUD::delete('denuncia', 'denunciado = ? AND tipo = ?', [$id_pet, 'pet']);
          CRUD::delete('relacao', 'pet_id = ?', [$id_pet]);
          CRUD::delete('pet', 'id = ?', [$id_pet]);
        }
        CRUD::commit();
        if ($deletado) {
          if (isset($img_src1) && file_exists(DIRETORIO_RAIZ.$img_src1))
          unlink(DIRETORIO_RAIZ.$img_src1);
        if (isset($img_src2) && file_exists(DIRETORIO_RAIZ.$img_src2))
          unlink(DIRETORIO_RAIZ.$img_src2);
        if (isset($img_src3) && file_exists(DIRETORIO_RAIZ.$img_src3))
          unlink(DIRETORIO_RAIZ.$img_src3);
          echo "deletado";
        }
    } catch (Exception $e) {
      CRUD::rollBack();
      throw new Exception("Error ao salvar no banco: ".$e->getMessage());
    }
  } catch (Exception $e) {
    echo "erro: ".$e->getMessage();
  }
}
