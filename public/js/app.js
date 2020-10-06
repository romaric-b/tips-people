
//Mise en session ou local storage de données utiles

//Lire des post en ajax
$('.posts-link').on('click', function()
{
	getPost();
})

//envoyer un post en ajax
/* $('#post_insert').on('click', function()
{
	//TODO étape vérification front du formulaire
	postPost();
}) */

$('#formPostAjax').on('submit', postPost);
