<?php
/**
 * Classe desenvolvida para validações
 *
 * @author Euclécio Josias Rodrigues <eucjosias@gmail.com>
 *
 */

Class FormMailValidation
{
	/**
	 * Validação do Google reCaptcha
	 *
	 * @var string $captcha
	 *
	 * @return boolean
	 *
	 */
	public static function reCaptcha($captcha)
	{
	    $response = json_decode(wp_remote_retrieve_body(wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=" . get_option('g_recaptcha_secret_key') . "&response=" . $captcha)), TRUE);
	    if ($response['success'] == false)
	        return false;
	    else
	    	return true;
	}
}
