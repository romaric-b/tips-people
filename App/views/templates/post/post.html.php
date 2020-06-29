<h1><?= $post->p_title ?></h1>
<small>Ecrit le <?= $post->p_datetime ?> par <?= $post->p_author_name ?> </small>
<p><?= $post->p_content ?></p>

<?php foreach ($comments as $comment): ?>
<h2>Commentaires</h2>
<small>Commentaire de <?= $comment->c_author_name?></small>
<p><?=$comment->c_content?></p>
<?php endforeach; ?>
