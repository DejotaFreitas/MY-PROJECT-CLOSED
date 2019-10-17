<?php if (URL::is_mobile()): ?>
    <style type="text/css">@import "<?php echo URL::webapp(); ?>css/slideshow-mobile.css";</style>
<?php else: ?>
  <style type="text/css">@import "<?php echo URL::webapp(); ?>css/slideshow.css";</style>
<?php endif; ?>



<div id="slideshow">
  <figure>
    <span class="trs next"></span>
    <span class="trs prev"></span>
    <div id="slider">

      <?php if (URL::is_mobile()): ?>
          <a href="meuspets" class="trs"><img class="img" src="<?php echo URL::webapp(); ?>img/slideshow/0_mobile.jpg" alt="Disponibilize pets para adoção, cadastre pets perdidos e encontrados."/></a>
      <?php else: ?>
          <a href="meuspets" class="trs"><img class="img" src="<?php echo URL::webapp(); ?>img/slideshow/0.jpg" alt="Disponibilize pets para adoção, cadastre pets perdidos e encontrados."/></a>
      <?php endif; ?>


      <?php if (URL::is_mobile()): ?>
          <a href="acessibilidade" class="trs"><img src="<?php echo URL::webapp(); ?>img/slideshow/1_mobile.jpg" alt="Personalize o petadote a sua necessidade."/></a>
      <?php else: ?>
          <a href="acessibilidade" class="trs"><img src="<?php echo URL::webapp(); ?>img/slideshow/1.jpg" alt="Personalize o petadote a sua necessidade."/></a>
      <?php endif; ?>


    </div>
  </figure>
</div>



<script src="<?php echo URL::webapp(); ?>js/slideshow.js" charset="utf-8"></script>
