<h1>Liste des articles</h1>

<?php foreach ($posts as $post) : ?>
   <h2><?= $post->p_title ?></h2>
    <small>Ecrit le <?= $post->p_datetime ?></small>
    <p><?= $post->p_extract ?></p>
    <a href="index.php?controller=post&task=show&id=<?= $post->p_id ?>">Lire la suite</a> 
<?php endforeach; ?> 

