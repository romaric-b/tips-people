
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
