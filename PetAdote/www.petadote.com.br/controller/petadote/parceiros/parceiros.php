<?php
if (!SessaoUsuario::logado()) {
  URL::pagina('home');
} else {
  if (SessaoUsuario::usuario()['tipo'] != 'i') {
    URL::pagina('home');
  }
}
