<?php

/**
 * Security class - Protect input and outputs 
 */
class Security
{
	public static function controlInput(?string $input ,?int $numberMaxCaracters,?string $inputType)
	{
		if(isset($input) && !empty($input) && is_string($input) && strlen($input) <= $numberMaxCaracters)
		{
			htmlspecialchars($input);
			trim($input); //TODO préciser à l'utilisateur le format des entrées attendues

			if($inputType == 'text')
			{
				return $input;
			}
			elseif($inputType == 'email')
			{
				if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $input))
				{
					return $input;
				}
				else
				{
					return $input = null;
				}
			}
			elseif($inputType == 'password')
			{
				return $input;
			}
			else
			{
				return $input = null;
			}
		}
		else
		{
			return $input = null;
		}
	}

	public static function controlMatchingPassword($password1, $password2)
	{
		if($password1 !== $password2)
		{
			/* $messsage = '<p>Les mots de passe rentrés sont différents.</p>';

			$cssFile = "/public/css/index.css";

			$pageTitle = "Erreur"; */

			//TODO ajax pour les erreurs

			/* \Renderer::render('message/error', compact('pageTitle', 'messsage', 'cssFile')); */
			return $password1 == null;
		}
		elseif($password1 == $password2)
		{
			return $password1 = password_hash($password1, PASSWORD_DEFAULT);
		}
	}
}
