<?php
if (!SessaoUsuario::logado()) {
  URL::pagina('entrar');
}
