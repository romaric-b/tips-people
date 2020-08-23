<?php
/* session_start(); */
$loggedUser = $_SESSION['u_nickname']; ?>
<h1><?= $post->p_title ?></h1>
<small>Ecrit le <?= $post->p_datetime ?> par <?= $post->p_author_name ?> </small>
<p><?= $post->p_content ?></p>

<?php 
var_dump($post->p_id);
 ?>

<?php if ( $loggedUser === $post->p_author_name );?>
	<div>
		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Modifier cet article
		</button>
	</div>
	<div class="collapse" id="collapseExample">
		<form class="marg-top" action="index.php?controller=post&task=update" method="post">
			<div class="control-group">
				<div class="form-group col floating-label-form-group controls">
					<label for="p_title">Titre de votre article</label>
					<input name="p_title" id="p_title" type="text" value="<?= $post->p_title ?>" maxlength="150"></input>

					<label for="message">Résumé de votre article</label>
					<textarea rows="3" class="form-control" name="p_extract" placeholder="Tapez votre commentaire" id="message" required><?= $post->p_extract ?></textarea>

					<label for="message">Contenu de votre article</label>
					<textarea rows="10" class="form-control" name="p_content" placeholder="Tapez votre commentaire" id="message" required><?= $post->p_content ?></textarea>
				</div>
			</div>
			<br>
			<div id="success-send"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="updateMessageButton"><i class="far fa-comment"></i> Soumettre</button>
			</div>
		</form>
	</div>

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
		<button type="submit" class="btn btn-primary" id="sendMessageButton"><i class="far fa-comment"></i>Soumettre</button>
	</div>
</form>

<?php if ($comments != NULL): ?>

	<?php foreach ($comments as $comment): ?>
	<h2>Commentaires</h2>
	<small>Commentaire de <?= $comment->c_author_name?></small>
	<p><?=$comment->c_content?></p>

	<?php if ($loggedUser === $comment->c_author_name); ?>
		<div>
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#comment-update" aria-expanded="false" aria-controls="comment-update">
				Modifier ce commentaire
			</button>
		</div>
		<div class="collapse" id="comment-update">
			<form class="marg-top" action="index.php?controller=comment&task=update&id=<?= $comment->c_id ?>" method="post">
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
					<button type="submit" class="btn btn-primary" id=""><i class="far fa-comment"></i>Soumettre</button>
				</div>
			</form>
		</div>
	

	<?php endforeach; ?>

<?php elseif($comments == NULL): ?>
	<p class="font-italic">Aucun commentaire à afficher</p>
<?php endif; ?>
