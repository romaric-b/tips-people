<h1>Liste des articles</h1>

<h2>Créer un nouvel article</h2>

<form class="marg-top" action="index.php?controller=post&task=insert" method="post">
	<div class="control-group">
		<div class="form-group col floating-label-form-group controls">
			<label for="p_title">Titre de votre article</label>
			<input name="p_title" id="p_title" type="text" maxlength="150"></input>

			<label for="message">Résumé de votre article</label>
			<textarea rows="3" class="form-control" name="p_extract" placeholder="Tapez votre commentaire" id="message" required></textarea>

			<label for="message">Contenu de votre article</label>
			<textarea rows="10" class="form-control" name="p_content" placeholder="Tapez votre commentaire" id="message" required></textarea>
		</div>
	</div>
	<br>
	<div id="success-send"></div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" id="sendMessageButton"><i class="far fa-comment"></i> Soumettre</button>
	</div>
</form>

<?php if ($posts != NULL): ?>
	
	<?php foreach ($posts as $post) : ?>
	<h2><?= $post->p_title ?></h2>
		<small>Ecrit le <?= $post->p_datetime ?></small>
		<p><?= $post->p_extract ?></p>
		<a href="index.php?controller=post&task=show&id=<?= $post->p_id ?>">Lire la suite</a> 
	<?php endforeach; ?> 

<?php elseif($posts == NULL): ?>
	<p class="font-italic">Aucun article à afficher</p>
<?php endif; ?>
