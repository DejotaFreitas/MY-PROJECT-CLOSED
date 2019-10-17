<?php
if (SessaoUsuario::logado()) {
    $time_noticia = URL::var();
    CRUD::delete('noticias', 'usuario_id=? AND time=?', [SessaoUsuario::usuario()['id'], $time_noticia]);
}
