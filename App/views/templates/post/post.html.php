<h1><?= $post->p_title ?></h1>
<small>Ecrit le <?= $post->p_datetime ?> par <?= $post->p_author_name ?> </small>
<p><?= $post->p_content ?></p>

<form class="marg-top" action="index.php?controller=comment&task=insert&id=<?= $post->p_id ?>" method="post">
	<div class="control-group">
		<div class="form-group col floating-label-form-group controls">
			<label for="c_title">Titre de votre commentaire</label>
			<input name="c_title" id="c_title" type="text" maxlength="150"></input>
			<label for="message">Votre commentaire</label>
			
			<textarea rows="5" class="form-control" name="c_content" placeholder="Tapez votre commentaire" id="message" required></textarea>
		</div>
	</div>
	<br>
	<div id="success-send"></div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" id="sendMessageButton"><i class="far fa-comment"></i> Soumettre</button>
	</div>
</form>

<?php if ($comments != NULL): ?>

	<?php foreach ($comments as $comment): ?>
	<h2>Commentaires</h2>
	<small>Commentaire de <?= $comment->c_author_name?></small>
	<p><?=$comment->c_content?></p>
	<?php endforeach; ?>

<?php elseif($comments == NULL): ?>
	<p class="font-italic">Aucun commentaire à afficher</p>
<?php endif; ?>
