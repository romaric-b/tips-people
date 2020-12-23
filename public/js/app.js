
//Mise en session ou local storage de données utiles

//Lire des post en ajax
$('.posts-link').on('click', function()
{
	getPost();
});

//Partie formulaires
function caracterNumber(field, minCaracterNb, maxCaracterNb)
{		
	//e.preventDefault();
	console.log(field);

	if (($(field).val().length >= minCaracterNb) && ($(field).val().length <= maxCaracterNb))
	{
		return;
	}
	else if (($(field).val().length < minCaracterNb) || ($(field).val().length > maxCaracterNb))
	{
		if($(field + '+ span').hasClass('error-field-nb'))
		{
			console.log('if nb carac');
			$(field + '+ span').css('font-weight', 'bold');
			
		}
		else
		{
			$(field).after(
				`<span class="error-field-nb">Ce champ doit contenir au minimum ${minCaracterNb} caractère et au maximum ${maxCaracterNb} caractères</span>`
			);
		}
	}	
}

function emailFormat(field)
{
	//test "fake@gmail.com"
	//version PHP "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix" //ok
	//const regex = /([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/gm; //invalid	
	const regex = /([a-z0-9+-]+)(.[a-z0-9+-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/; //invalid
	
	console.log(regex);
	var email = $(field).val();
	console.log(email)

	if (regex.test(email))
	{
		console.log('valid email');
		return;
	}
	else
	{
		$(field).after(
			`<span class="error-field">Le format de l\'adresse email est incorrect ou le champ est vide</span>`
		);
	}
}

function matchingPasswords(field, field2)
{
	if ($(field).val() == $(field2).val ())
	{
		console.log('valid pass');
		return;
	}
	else
	{
		$(field).after(
			`<span class="error-field">Les mots de passes saisis sont différents</span>`
		);
	}
}

/*
caracterNumber('#p_title', 150);
caracterNumber('#p_extract', 300);
caracterNumber('#p_content', 5000);*/

//envoyer un post en ajax
$('#formPostAjax').on('submit', function(e)
{
	//TODO étape vérification front du formulaire
	caracterNumber('#p_title', 2, 150);
	caracterNumber('#p_extract', 10, 300);
	caracterNumber('#p_content', 100, 5000);
	postPost(e); 
});

//$('#formPostAjax').on('submit', postPost); //FONCTIONNE
$('#formCommentAjax').on('submit', function(e)
{
	//TODO étape vérification front du formulaire
	caracterNumber('#c_title', 2, 150);
	caracterNumber('#c_content', 100, 5000);
	postComment(e); 
});

/********************************
 * 
 *  A FAIRE SI TEMPS DISPO
 * 
 ********************************/
//UPDATE COMMENT EN AJAX
/* $('#formCommentUpdateAjax').on('submit', function(e)
{	
	caracterNumber('#c_title_update', 2, 150);
	caracterNumber('#c_content_update', 100, 5000);
	updateComment(e); 
}); */

$('#register-form').on('submit', function(e)
{
	caracterNumber('#regist--nickname', 1, 30);
	emailFormat('#regist--email');
	caracterNumber('#regist--password', 1, 30);
	caracterNumber('#regist--password-two', 1, 30);
	matchingPasswords('#regist--password', '#regist--password-two');

	e.preventDefault();
	const u_nickname = $('#regist--nickname');
	const u_email = $('#regist--email');
	const u_password = $('#regist--password');

	const data = new FormData();

	//TODO récupérer l'intérieur des input
	data.append('u_nickname', u_nickname.val());
	data.append('u_email', u_email.val());
	data.append('u_password', u_password.val());

	/* console.log(data); */ 
	console.log(Array.from(data.values()));

	const request = new XMLHttpRequest;
	
	//Direction le controller PHP
	request.open('POST', 'index.php?controller=user&task=insert');
	console.log('passe');

	Registred = false;

	request.onload = function()
	{
		if(Registred == false)
		{
			$('#register-form').after('<span>Votre inscription a bien été prise en compte et comment a bien me casser les couilles, je vais pas GET tes données alors que t as même pas validé le mail sale baltringue, retourne bosser au lieu de t inscrire sur mon site bugué !</span>');

			var Registred = true;
		}
		else
		{
			$('#register-form').after('<span>Vous êtes déjà inscrit, si vous souhaitez inscrire un nouveau compte merci de rafraichir cette page</span>');
			
		}
	}

	request.send(data);
});
