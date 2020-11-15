<?php if ($_SESSION['u_role'] == 'Modérateur' || $_SESSION['u_role'] == 'Administrateur' && !empty($_SESSION['u_role'])):	
?>

<h1 class="title-page"><?= $pageTitle ?></h1>

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
				
				<button type="submit" class="btn-warning mt-3" role="button">Retirer signalement</button>
			</form>
			<a href="index.php?controller=comment&task=delete&id=<?= $comment->c_id ?>" class="btn btn-danger mt-3 mb-3 p-1"><i class="fas fa-user-alt-slash"></i>Supprimer</a>
		</div>
    </div>
    <?php endforeach; ?>
</div>
<div class="text-white">Pages :</div>
	<?php
	for($i=1; $i<=$totalPages; $i++)
	{
		echo '<a class="text-white-50" href="index.php?controller=comment&task=dashboard&page='.$i.'">'.$i.'</a> ';
	}
		?>
</div>
<?php elseif (!$_SESSION['u_role'] != 'Modérateur' || empty($_SESSION['u_role'])):?>
	<?php \Http::redirect("index.php?controller=post&task=index"); ?>
<?php endif;?>
