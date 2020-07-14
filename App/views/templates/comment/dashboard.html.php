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
		<div class="col">Vote(s)</div>
		<div class="col">Catégorie</div>
    </div>
  </div>
  <div class="pl-tbody">

  <?php foreach ($comments as $comment): ?>
    <div class="row">
		<div class="col"><?= $comment->c_id ?></div>
		<div class="col">
			<?= $comment->p_extract ?>
			<a href="index.php?controller=post&task=show&id=<?= $comment->c_post_fk ?>">Voir l'article</a> <!--TODO vérifier que j'ai bien l'id de l'article et le bon dans c_post_fk -->
		</div>
		<div class="col"><?= $comment->c_author_name ?></div>
		<div class="col"><?= $comment->c_datetime ?></div>
		<div class="col"><?= $comment->c_status ?></div>
		<div class="col"><?= $comment->c_reporting ?></div>
		<div class="col"><?= $comment->c_vote ?></div>
		<div class="col"><?= $comment->p_category ?></div>
    </div>
    <?php endforeach; ?>
</div>
