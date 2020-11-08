<article class="full-vh info--article">
	<p class="text-color"><?php echo $information ?></p>

	<?php if(isset($_SESSION['p_id'])): ?>
	<a href="index.php?controller=post&task=show&id=<?=$_SESSION['p_id'];?>">Retour vers l'article</a>
	<?php endif; ?>

</article>

