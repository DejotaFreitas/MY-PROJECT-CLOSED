<?php
if (!SessaoUsuario::logado()) {
  URL::pagina('home');
}
