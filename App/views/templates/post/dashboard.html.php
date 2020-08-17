<h1><?= $pageTitle ?></h1>

	<!-- <h3>Default</h3> -->
<div role="table" class="pl-table">
	<div class="pl-thead">
		<div class="row">
			<div class="col">Identifiant</div>
			<div class="col">Titre</div>
			<div class="col">Extrait</div>
			<div class="col">Auteur</div>
			<div class="col">Date</div>
			<div class="col">Statut</div>
			<div class="col">Signalement(s)</div>
			<div class="col">Vote(s)</div>
			<div class="col">Catégorie</div>
			<!-- <div class="col">Nombre commentaire(s)</div> -->
		</div>
	</div>
  <div class="pl-tbody">

  	<?php foreach ($items as $post): ?>
    <div class="row">
			<div class="col"><?= $post->p_id ?></div>
			<div class="col"><?= $post->p_title ?></div>
			<div class="col"><?= $post->p_extract ?></div>
			<div class="col"><?= $post->p_author_name ?></div>
			<div class="col"><?= $post->p_datetime ?></div>
			<div class="col"><?= $post->p_status ?></div>
			<div class="col"><?= $post->p_reporting ?></div>
			<div class="col"><?= $post->p_vote ?></div>
			<div class="col"><?= $post->p_category ?></div>
		<!-- <div class="col">$post->p_nb_comment</div> -->
    </div>
   <?php endforeach; ?>
</div>
