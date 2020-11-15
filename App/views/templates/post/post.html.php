<?php

if (isset($_SESSION['u_nickname']))
{
	$loggedUser = $_SESSION['u_nickname'];
}
else
{
	$loggedUser = '';
}

?>

<article class="post">
	<h1 class="title-page"><?= $post->p_title ?></h1>
	<span>Ecrit le <?= $post->p_datetime ?> par <?= $post->p_author_name ?> </span>
	<p><?= $post->p_content ?></p>
	<form action="index.php?controller=post&task=signalPost" method="post">
		<input type="hidden" name="p_id_signal" value="<?= $post->p_id ?>">
		
		<button type="submit" role="button">Signaler</button>
	</form>
</article>


<?php
?>

<?php if ( $loggedUser === $post->p_author_name ):
	
?>
	<div>
		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Modifier cet article
		</button>
		<!-- <a class="btn btn-danger" data-toggle="modal" data-target="#delete-modal"  href="#"><i class="far fa-edit"></i>Effacer commentaire</a> -->
	</div>
	<div class="collapse" id="collapseExample">
		<form class="marg-top" action="index.php?controller=post&task=update" method="post">
			<div class="control-group">
				<div class="form-group col floating-label-form-group controls">
					<label for="p_title">Titre de votre article</label>
					<input name="p_title" id="p_title" type="text" value="<?= $post->p_title ?>" maxlength="150"></input>

					<label for="message">Résumé de votre article</label>
					<textarea rows="3" class="form-control tinymce-edition" name="p_extract" placeholder="Tapez votre commentaire" id="message" required><?= $post->p_extract ?></textarea>

					<label for="message">Contenu de votre article</label>
					<textarea rows="10" class="form-control tinymce-edition" name="p_content" placeholder="Tapez votre commentaire" id="p_content" required><?= $post->p_content ?></textarea>
				</div>
			</div>
			<br>
			<div id="success-send"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="updateMessageButton"><i class="far fa-comment"></i> Soumettre</button>
			</div>
		</form>
	</div>
<?php endif;?>

<?php if ($loggedUser != '' ):?>
<form class="marg-top" id="formCommentAjax" method="post">
	<div class="control-group">
		<div class="form-group col floating-label-form-group controls">
			<label for="c_title">Titre de votre commentaire</label>
			<input name="c_title" id="c_title" type="text" maxlength="150"></input>
			<label for="c_content">Votre commentaire</label>
			
			<textarea rows="5" class="form-control tinymce-edition" name="c_content" placeholder="Tapez votre commentaire" id="c_content" required></textarea>
			<input type="hidden" name="p_id" value="<?= $post->p_id ?>"
		</div>
	</div>
	<br>
	<div id="success-send"></div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" id="sendMessageButton"><i class="far fa-comment"></i>Soumettre</button>
	</div>
</form>
<?php endif;?>

<?php if ($comments != NULL): ?>
	<div class="container-comments">
	
	<h2 class="title-section">Commentaires</h2>
	<?php foreach ($comments as $comment): ?>
	<div id="<?= $comment->c_id ?>" class="comment--div">
		<span class="comment-info--span">Commentaire de <?= $comment->c_author_name?>, <?= $comment->c_datetime?></span>
		<p><?=$comment->c_content?></p>
		<form action="index.php?controller=comment&task=signalComment" method="post">

			<input type="hidden" name="c_id_signal" value="<?= $comment->c_id ?>">
			
			<button type="submit" role="button">Signaler</button>
		</form>		
	</div>
	
	<?php if ($loggedUser === $comment->c_author_name): ?>
		<div class="update-comment--div">
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#comment-update-<?= $comment->c_id ?>" aria-expanded="false" aria-controls="comment-update">
				Modifier ce commentaire
			</button>
		</div>
		<div class="collapse" id="comment-update-<?= $comment->c_id ?>">
		<!--id="formCommentUpdateAjax"  -->
			<form class="marg-top" action="index.php?controller=comment&task=update" method="post">
				<div class="control-group">
					<div class="form-group col floating-label-form-group controls">
						<label for="c_title_update">Titre de votre commentaire</label>
						<input name="c_title_update" id="c_title_update" type="text" maxlength="150"></input>
						<label for="message">Votre commentaire</label>
						
						<textarea rows="5" class="form-control tinymce-edition" name="c_content_update" placeholder="Tapez votre commentaire" id="c_content_update" required></textarea>
						<input type="hidden" name="c_id" value="<?= $comment->c_id ?>">
					</div>
				</div>
				<br>
				<div id="success-send"></div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" id="updateCommentButton"><i class="far fa-comment"></i>Soumettre</button>
				</div>
			</form>
		</div>
	<?php endif;?>		
	<?php endforeach; ?>
	
	</div>
<?php elseif($comments == NULL): ?>
	<p class="font-italic">Aucun commentaire à afficher</p>
<?php endif;?>
