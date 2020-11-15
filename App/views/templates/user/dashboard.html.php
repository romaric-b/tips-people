<?php if ($_SESSION['u_role'] == 'Modérateur' || $_SESSION['u_role'] == 'Administrateur' && !empty($_SESSION['u_role'])):	
?>

<h1 class="title-page"><?= $pageTitle ?></h1>

	<!-- <h3>Default</h3> -->
<div role="table" class="pl-table">
  <div class="pl-thead">
    <div class="row">
		<div class="col">Identifiant utilisateur</div>
		<div class="col">Pseudo</div>
		<div class="col">Date d'inscription</div>
		<div class="col">email</div>
		<div class="col">role</div>
		<div class="col">Action</div>
    </div>
  </div>
  <div class="pl-tbody">

  <?php foreach ($items as $user): ?>
    <div class="row">
		<div class="col"><?= $user->u_id ?></div>
		<div class="col"><?= $user->u_nickname ?></div>
		<div class="col"><?= $user->u_datetime ?></div>
		<div class="col"><?= $user->u_email ?></div>
		<div class="col"><?= $user->u_role ?></div>
		<div class="col">
			<div class="btn-group f-col" role="group" aria-label="actions">
				<?php if ($user->u_role != 'Administrateur'): ?>
				<form target="_blank" action="index.php?controller=user&task=upgradeMember" method="post">
					<input type="hidden" name="u_id_upgrade" value="<?= $user->u_id ?>">
					
					<button type="submit" class="btn-warning mt-3" role="button">Promouvoir Modérateur</button>
				</form>
				<form target="_blank" action="index.php?controller=user&task=downgradeMember" method="post">
					<input type="hidden" name="u_id_downgrade" value="<?= $user->u_id ?>">
					
					<button type="submit" class="btn-warning mt-3" role="button">Retirer rôle Modérateur</button>
				</form>
				<a href="index.php?controller=user&task=delete&id=<?= $user->u_id ?>" class="btn btn-danger mt-3 mb-3 p-1"><i class="fas fa-user-alt-slash"></i>Bannir membre</a>
				<?php endif;?>
			</div>
		</div>		
    </div>
    <?php endforeach; ?>
</div>
<div class="text-white">Pages :</div>
<?php
for($i=1; $i<=$totalPages; $i++)
{
	echo '<a class="text-white-50" href="index.php?controller=user&task=dashboard&page='.$i.'">'.$i.'</a> ';
}
	?>
</div>
<?php endif;?>
<?php if ($_SESSION['u_role'] != 'Modérateur' || empty($_SESSION['u_role'])):?>
	<?php \Http::redirect("index.php?controller=post&task=index"); ?>
<?php endif;?>
