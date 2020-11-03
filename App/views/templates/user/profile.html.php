<?php if (isset($_SESSION['u_nickname']) && !empty($_SESSION['u_nickname'])):	
?>
<section>
	<h1>Informations sur votre profil</h1>

	<ul>
		<li>Pseudo : <?php echo $_SESSION['u_nickname']?></li>
		<li>Adresse email : <?php echo $_SESSION['u_email']?></li>
		<li>Rôle : <?php echo $_SESSION['u_role']?></li>
		<li>Date d'inscription : <?php echo $_SESSION['u_datetime']?></li>
	</ul>
</section>
<?php endif;?>
<?php if (!isset($_SESSION['u_nickname'])):?>
	<section>
		<p>Vous devez être connecté pour voir cette page</p>
	</section>
<?php endif;?>
