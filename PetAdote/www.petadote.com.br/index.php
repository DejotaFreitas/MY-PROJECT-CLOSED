<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
  <head>    
    <!-- Usar o dominio do site na base das ancoras html -->
    <base href="<?php echo DOMINIO; ?>">
    <!-- CABECALHO DA HTML -->
    <?php if (URL::head()) require_once(URL::head()); ?>
    <!-- CSS DA ROTA -->
    <style type="text/css">
      <?php if (URL::css()) foreach (URL::css() as $css): ?>
        @import "<?php echo URL::webapp(); ?>css/<?php echo $css ?>.css";
      <?php endforeach; ?>
    </style>

    <!-- IMPEDIR O CHACE DO FORM, RESOLVENDO PROBLEMA DO BOTAO VOLTAR -->
    <meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate"/>
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1"/>

  </head>
  <body ondragstart='return false' > <!-- impede de arrastar as imagens da pagina -->

    <!-- CABECALHO DA PAGINA -->
    <?php if (URL::header()) require_once(URL::header());?>

    <!-- CORPO  DA PAGINA -->
    <?php require_once(URL::pagina()); ?>

    <!-- RODA-PÈ  DA PAGINA -->
    <?php if (URL::footer()) require_once(URL::footer()); ?>

    <!-- JAVASCRIPT DA ROTA -->
    <?php if (URL::js()) foreach (URL::js() as $js): ?>
      <script src="<?php echo URL::webapp(); ?>js/<?php echo $js ?>.js" charset="utf-8"> </script>
    <?php endforeach; ?>

  </body>
</html>
