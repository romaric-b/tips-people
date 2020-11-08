<?php if ($_SESSION['u_role'] == 'Modérateur' && !empty($_SESSION['u_role'])):	
?>

<h1><?= $pageTitle ?></h1>

	<!-- <h3>Default</h3> -->
<div role="table" class="pl-table">
  <div class="pl-thead">
    <div class="row">
		<div class="col">Identifiant du commentaire</div>
		<div class="col">Titre de l'article commenté</div>
		<div class="col">Auteur</div>
		<div class="col">Date</div>
		<div class="col">Statut</div>
		<div class="col">Signalement(s)</div>
		<div class="col">Actions</div>
    </div>
  </div>
  <div class="pl-tbody">

  <?php foreach ($items as $comment): ?>
    <div class="row">
		<div class="col"><?= $comment->c_id ?></div>
		<div class="col">
			<?= $comment->p_extract ?>
			<a target="_blank" href="index.php?controller=post&task=show&id=<?= $comment->c_post_fk ?>#<?= $comment->c_id ?>">Aller au commentaire</a> <!--TODO vérifier que j'ai bien l'id de l'article et le bon dans c_post_fk -->
		</div>
		<div class="col"><?= $comment->c_author_name ?></div>
		<div class="col"><?= $comment->c_datetime ?></div>
		<div class="col"><?= $comment->c_status ?></div>
		<div class="col"><?= $comment->c_reporting ?></div>
		<div class="col">
			<form action="index.php?controller=comment&task=moderateComment" method="post">
				<input type="hidden" name="c_id_signal" value="<?= $comment->c_id ?>">
				
				<button type="submit" role="button">Retirer signalement</button>
			</form>
		</div>
    </div>
    <?php endforeach; ?>
</div>
<?php elseif (!$_SESSION['u_role'] != 'Modérateur' || empty($_SESSION['u_role'])):?>
	<?php \Http::redirect("index.php?controller=post&task=index"); ?>
<?php endif;?>
