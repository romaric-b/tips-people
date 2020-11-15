<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $description;?>">
    <meta name="author" content="<?= $author = 'Invest People';?>">
    <title><?= $title;  ?></title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="./public/css/header.css" rel="stylesheet" />
	<link href="./public/css/index.css" rel="stylesheet" />	
    <!-- Custom fonts for this template -->
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<div class="page-container">
		<nav class="navbar navbar-expand-md navbar-dark fixed-top" id="banner">
			<div class="container-lg">
				<!-- Brand -->
				<a class="navbar-brand" href="#"><span>Logo</span> Here</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

			<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto">
						
						<?php if(isset($_SESSION['u_nickname']) && !empty($_SESSION['u_nickname'])):?>				
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?controller=user&task=viewProfile">Mon profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?controller=user&task=disconnect">Déconnexion</a>
						</li>
						<?php endif;?>
						<?php if(!isset($_SESSION['u_nickname'])):?>
						<li class="nav-item">
							<a class="nav-link text-white" id="open-register-form"  data-toggle="modal" data-target="#register-modal" href="#">Inscription</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" data-toggle="modal" data-target="#login-modal"  href="#">Connexion</a>
						</li>
						<?php endif;?>
						<li class="nav-item">
							<a class="nav-link text-white posts-link" href="index.php?controller=post&task=index">Articles</a>
							<!--<a class="nav-link posts-link" href="#">Articles</a>-->
						</li> 
						<?php if (isset($_SESSION['u_role']) && $_SESSION['u_role'] == 'Modérateur'):?>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?controller=post&task=dashboard">Gestion Articles</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?controller=comment&task=dashboard">Gestion Commentaires</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="index.php?controller=user&task=dashboard">Gestion Membres</a>
						</li>
						<?php endif;?>
					<!-- Dropdown -->
						
					</ul>
				</div>
			</div>
		</nav>


		<!--Register Modal-->
		<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="inscription-modal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<h1 class="modal-title" id="inscription-modal">Inscription</h1>
						<button type="button" id="close-regist-modal" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="d-flex flex-column" action="index.php?controller=user&task=insert" method="POST">
							<p>
								<span>* Ces champs sont obligatoires</span>
								<label class="d-flex flex-column" for="regist--nickname">Entrez votre pseudo comportant 1 à 30 caractères * :
									<input type="text" name="u_nickname" placeholder="Pseudo" id="regist--nickname" value=""  required/>
								</label>
								<label class="d-flex flex-column" for="regist--email">Entrez votre adresse email * :
									<input type="email" name="u_email" placeholder="Email" id="regist--email" required/>
								</label>
								<label class="d-flex flex-column" for="regist--password">Tapez votre mot de passe comportant 1 à 30 caractères * :
									<input type="password" name="u_password" placeholder="Mot de passe" id="regist--password" required/>
								</label>
								<label class="d-flex flex-column" for="regist--password">Retapez votre mot de passe * :
									<input type="password" name="u_password2" placeholder="Mot de passe" id="regist--password" required/>
								</label>						
							</p>
							<p>
								<input class="btn btn-primary" type="submit" name="registForm" value="Valider"/>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!--Login Modal-->
		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" id="login-modal-label">Connexion</h1>
						<button type="button" id="close-login-modal" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="d-flex flex-column" action="index.php?controller=user&task=login" method="POST">
							<p class="d-flex flex-column">
								<span>* Ces champs sont obligatoires</span>
								<label class="d-flex flex-column" for="login--nickname">Entrez votre pseudo * :
									<input type="text" name="u_nickname" placeholder="Pseudo" id="login--nickname" required/>
								</label>
								<label class="d-flex flex-column" for="login--password">Tapez votre mot de passe * :
									<input type="password" name="u_password" placeholder="Mot de passe"  id="login--password" required/>
								</label>
								Vous n'êtes pas inscrit ? <a class="nav-link" id="open-register-form" data-dismiss="modal" data-toggle="modal" data-target="#register-modal" href="#">Inscrivez-vous ici</a>
							</p>
							<p>
								<input  class="btn btn-primary"  type="submit" name="loginForm" value="Se connecter"/>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>

		<main class="main-page container-grid-4">
			<?= $pageContent; ?>
		</main>

		<input id="u_id" type="hidden" value="
			<?php 
				if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id']))
				{
					//user's id logged
					echo $_SESSION['u_id'];
				}
				else
				{
					//for no user logged
					echo 'no logged user';
				}
			?>"
		>

		<input id="p_id" name="p_id" type="hidden" value="
			<?php 
				if(isset($_SESSION['p_id']) && !empty($_SESSION['p_id']))
				{
					//user's id logged
					echo $_SESSION['p_id'];
				}
				else
				{
					//for no user logged
					echo 'no post oppened';
				}
			?>"
		>	
	</div>
	<!--TinyMCE-->
	<!-- <script src="https://cdn.tiny.cloud/1/sguduqeo4kbrmiicmeazgnj892slxkt1nd2wz04afbus4c3y/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'.tinymce-edition', language : 'fr_FR'});</script> -->
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
	<script src="./public/js/ajax.js"></script>
	<script src="./public/js/header.js"></script>
	<script src="./public/js/graph.js"></script>
	<script src="./public/js/app.js"></script>
</body>
