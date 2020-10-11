/*************************************************
 * 
 * 				POSTS
 * 
 *************************************************/

getPosts = function()
{
	//Créer la requête pour se co au serveur et au bon controller
	var request = new XMLHttpRequest;
	request.open("GET", 'index.php?controller=post&task=ajaxIndex');

	//Une fois les data reçues, il faut les traiter, puis les afficher au format html
	request.onload = function()
	{
		//responseText = voir ce que le serv a répondu
		var results = JSON.parse(request.responseText);

		var html = results.map(function(post)
		{
			return `
			<article class="post_${post.p_id}">
				<h2>${post.p_title}</h2>
				<small>Ecrit le ${post.p_datetime} par ${post.p_author_name}</small>
				<p>${post.p_extract}</p>
				<a href="index.php?controller=post&task=show&id=${post.p_id}">Lire la suite</a> 
			</article>
			`;
		}).join('');
		//join permet de convertir array en chaine de caractère
		console.log(html);
		$('.container-posts').html(html);
	}
	//Envoie de la requête
	request.send();
}

//Poster aritlces, commentaires ou données utilisateurs
function postPost(e)
{
	console.log('postPost lancée');
	//1 stopper le submit du formulaire
	e.preventDefault();

	//2 récupérer les données du formulaire
	const p_title = $('#p_title');
	const p_extract = $('#p_extract');
	const p_content = $('#p_content');
	const p_author_fk = $('#u_id');

	//console.log();
	//3 conditionner les données
	const data = new FormData();

	//TODO récupérer l'intérieur des input
	data.append('p_title', p_title.val());
	data.append('p_extract', p_extract.val());
	data.append('p_content', p_content.val());

	data.append('p_author_fk', p_author_fk.value);
	console.log(data);

	//4 configuration requête ajax en POST et envoie des données
	const request = new XMLHttpRequest;
	//Direction le controller PHP
	request.open('POST', 'index.php?controller=post&task=insert');

	//Ce que la requête fait lorsquelle est terminée
	request.onload = function()
	{
		//Vider les champs du formulaire après écriture
		/* p_title.val('');
		p_extract.val('');
		p_content.val(''); */
		getPosts();
	}

	request.send(data);
}

/*************************************************
 * 
 * 				COMMENTS
 * 
 *************************************************/
getComments = function()
{
	//Créer la requête pour se co au serveur et au bon controller
	var request = new XMLHttpRequest;
	request.open("GET", 'index.php?controller=comment&task=ajaxComments');

	//Une fois les data reçues, il faut les traiter, puis les afficher au format html
	request.onload = function()
	{
		//responseText = voir ce que le serv a répondu
		var results = JSON.parse(request.responseText);

		var html = results.map(function(comment)
		{
			return `
			<article class="_${comment.c_id}">
				<small>Ecrit le ${comment.c_datetime} par ${comment.c_author_name}</small>
				<h2>${comment.c_title}</h2>
				<p>${comment.c_content}</p>
			</article>	
			`;
		}).join('');
		//join permet de convertir array en chaine de caractère
		console.log(html);
		$('.container-comments').html(html);
	}
	//Envoie de la requête
	request.send();
}

//Poster aritlces, commentaires ou données utilisateurs
function postComment(e)
{
	console.log('postComment lancée');
	//1 stopper le submit du formulaire
	e.preventDefault();

	//2 récupérer les données du formulaire
	const c_title = $('#c_title');
	const c_content = $('#c_content');
	const c_author_fk = $('#u_id');

	//console.log();
	//3 conditionner les données
	const data = new FormData();

	//TODO récupérer l'intérieur des input
	data.append('c_title', c_title.val());
	data.append('c_content', c_content.val());
	data.append('c_author_fk', c_author_fk.value);
	console.log(data);

	//4 configuration requête ajax en POST et envoie des données
	const request = new XMLHttpRequest;
	//Direction le controller PHP
	request.open('POST', 'index.php?controller=comment&task=insert');

	//Ce que la requête fait lorsquelle est terminée
	request.onload = function()
	{
		//Vider les champs du formulaire après écriture
		/* p_title.val('');
		p_extract.val('');
		p_content.val(''); */
		getComments();
	}
	request.send(data);
}
