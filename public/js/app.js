
//Mise en session ou local storage de données utiles

//Lire des post en ajax
$('.posts-link').on('click', function()
{
	getPost();
});



//Partie formulaires
function caracterNumber(e, field, minCaracterNb, maxCaracterNb)
{
	
	e.preventDefault();
	//console.log($(field).val().length);

	if (($(field).val().length >= minCaracterNb) && ($(field).val().length <= maxCaracterNb))
	{
		return;
	}
	else if (!($(field).val().length >= minCaracterNb) && !($(field).val().length <= maxCaracterNb))
	{
		console.log('dans la bonne condition');
		$(field).after(
			`<span class="error-field">Ce champ doit contenir au minimum ${minCaracterNb} maximum ${maxCaracterNb} caractères</span>`
		);
	}
	else if ($(field).val().length == 0)
	{
		$(field).after(
			`<span class="error-field">Ce champ ne peut être vide</span>`
		);
	}
}

function emailFormat(field)
{
	const regex = /([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/gm;
	
	if (regex.test($(field)))
	{
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
	caracterNumber(e, '#p_title', 1, 150);
	caracterNumber(e, '#p_extract', 10, 300);
	caracterNumber(e, '#p_content', 200, 5000);
	postPost(e); //ReferenceError: e is not defined
});

//$('#formPostAjax').on('submit', postPost); //FONCTIONNE
