<h1><?= $pageTitle ?></h1>

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
			<div class="btn-group" role="group" aria-label="actions">
				<a href="index.php?controller=user&task=delete&id=<?= $user->u_id ?>" class="btn btn-danger p-1"><i class="fas fa-user-alt-slash"></i>Bannir membre</a>
			</div>
		</div>		
    </div>
    <?php endforeach; ?>
</div>
