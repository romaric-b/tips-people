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

<h1 class="title-page">Liste des articles</h1>

<h2 class="title-section">Créer un nouvel article</h2>

	<div class="left-bloc">
		<?php if ($loggedUser != ''):?>
		<article class="container-grid-4">
			<form class="marg-top" id="formPostAjax"  method="post">
				<div class="control-group">
					<div class="form-group col floating-label-form-group controls">
						<label for="p_title">Titre de votre article</label>
						<input name="p_title" id="p_title" type="text" maxlength="150"></input>

						<label for="p_extract">Résumé de votre article</label>
						<textarea rows="3" class="form-control" name="p_extract" placeholder="Tapez votre commentaire" id="p_extract"></textarea>

						<label for="p_content">Contenu de votre article</label>
						<textarea rows="10" class="form-control" name="p_content" placeholder="Tapez votre commentaire" id="p_content"></textarea>
					</div>
				</div>
				<br>
				<div id="success-send"></div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" id="post_insert"><i class="far fa-comment"></i> Soumettre</button>
				</div>
			</form>
		</article>

		<?php elseif($loggedUser == ''):?>
			<article class="post-connexion">
				<a class="nav-link" data-toggle="modal" data-target="#login-modal" href="#">Connectez-vous pour écrire un article</a>
				<p class="block">Si vous n'avez pas encore de compte, vous pouvez <a class="nav-link inline" id="open-register-form" data-toggle="modal" data-target="#register-modal" href="#">vous inscrire</a></p>
			</article>
			
		<?php endif;?>
		<!--TODO Relecture modale relecture/confirmation avant envoie-->

		<section class="container-posts">
			<?php if ($posts != NULL): ?>
				<?php foreach ($posts as $post) : ?>
					<article class="post_<?= $post->p_id ?>">
						<h2><?= $post->p_title ?></h2>
						<small>Ecrit le <?= $post->p_datetime ?> par <?= $post->p_author_name ?></small>
						<p><?= $post->p_extract ?></p>
						<a href="index.php?controller=post&task=show&id=<?= $post->p_id ?>">Lire la suite</a> 
					</article>
				<?php endforeach; ?> 

			<?php elseif($posts == NULL): ?>
				<p class="font-italic">Aucun article à afficher</p>
			<?php endif; ?>
		</section>	
	</div>

	<div class="right-bloc receive-flux-twitter">
	</div>

