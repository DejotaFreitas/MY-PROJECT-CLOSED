<?php
if (SessaoUsuario::logado()) {
  SessaoUsuario::deslogar();  
} else {
  URL::pagina('home');
}
