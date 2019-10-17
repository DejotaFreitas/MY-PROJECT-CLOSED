<?php
if (!SessaoUsuario::logado() || SessaoUsuario::usuario()['tipo'] != 'i') {
  URL::pagina('home');
}
