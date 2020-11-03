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
			<div class="col">Catégorie</div>
			<div class="col">Actions</div>
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
		<div class="col"><?= $post->p_category ?></div>
		<div class="col">
		<div class="btn-group" role="group" aria-label="actions">				
			<a href="index.php?controller=post&task=show&id=<?= $post->p_id ?>" class="btn btn-danger p-1"><i class="fas fa-user-alt-slash"></i>Voir l'article</a>
			<!-- <a href="index.php?controller=post&task=update&id=<?= $post->p_id ?>" class="btn btn-danger p-1"><i class="fas fa-user-alt-slash"></i>Modifier</a> -->
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#update-post" aria-expanded="false" aria-controls="collapseExample">
				Modifier cet article
			</button>
			<a href="index.php?controller=post&task=delete&id=<?= $post->p_id ?>" class="btn btn-danger p-1"><i class="fas fa-user-alt-slash"></i>Supprimer</a>
		</div>
	</div>		
		<!-- <div class="col">$post->p_nb_comment</div> -->
    </div>
   <?php endforeach; ?>
</div>

<section>
	<div class="collapse" id="update-post">
		<form class="marg-top" action="index.php?controller=post&task=update" method="post">
			<div class="control-group">
				<div class="form-group col floating-label-form-group controls">
					<label for="p_title">Titre de votre article</label>
					<input name="p_title" id="p_title" type="text" value="<?= $post->p_title ?>" maxlength="150"></input>

					<label for="message">Résumé de votre article</label>
					<textarea rows="3" class="form-control" name="p_extract" placeholder="Tapez votre commentaire" id="message" required><?= $post->p_extract ?></textarea>

					<label for="message">Contenu de votre article</label>
					<textarea rows="10" class="form-control" name="p_content" placeholder="Tapez votre commentaire" id="p_content" required><?= $post->p_content ?></textarea>
				</div>
			</div>
			<br>
			<div id="success-send"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="updateMessageButton"><i class="far fa-comment"></i> Soumettre</button>
			</div>
		</form>
	</div>
</section>
