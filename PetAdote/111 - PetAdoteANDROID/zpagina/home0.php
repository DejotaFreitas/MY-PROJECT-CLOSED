<h1>HOME <?php echo time(); ?> </h1>

<?php
function listar_caminhos($diretorio, &$todos_caminho=[]) {
    $arquivos_ignorados = array(".", "..");
    $lista_arquivos_diretorios = scandir($diretorio);
    foreach($lista_arquivos_diretorios as $arquivo) {
        $caminho = $diretorio.'/'.$arquivo;
        if (!in_array($arquivo, $arquivos_ignorados)) {
            if (is_file($caminho) && is_readable($caminho)) {
                $todos_caminho[] = $caminho;
            } elseif (is_dir($caminho) && is_readable($caminho)) {
                listar_caminhos($caminho, $todos_caminho);
            }
        }
    }
    return $todos_caminho;
}
  $dir = 'img';
  $caminhos = listar_caminhos($dir);
  foreach ($caminhos as $caminho):
    ?> <img src="<?php echo $caminho; ?>" alt="img"> <?php
  endforeach;
 ?>
