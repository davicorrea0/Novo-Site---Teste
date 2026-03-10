<?php
/**
 * Classe desenvolvida para o uso de helpers
 *
 * @author Euclécio Josias Rodrigues <eucjosias@gmail.com>
 *
 */

Class FormMailHelper
{
	/**
	 * Função responsável pelas mensagens de feedback para o usuário
	 *
	 * @var string $key
	 * @var string $value
	 *
	 * @return array()
	 *
	 * @example
	 * Adicionando mensagens:
	 * FormMailHelper::feedback('key', 'Mensagem aqui');
	 *
	 * @example
	 * Recuperando mensagens:
	 * FormMailHelper::feedback() retorna um array com todas as mensagens
	 *
	 * @example
	 * Recuperando mensagens:
	 * FormMailHelper::feedback('key') retorna um array com as mensagens apenas com a chave
	 *
	 * @example
	 * Imprimindo mensagens:
	 * <?php foreach(FormMailHelper::feedback('key') as $message): ?>
	 *		<?php echo $message ?>
	 * <?php endforeach ?>
	 * 
	 */
	public static function feedback($key = null, $value = null)
	{
		if(isset($value))
		{
			if (isset($key))
				$newMessage = array($key => $value);
			else
				$newMessage = array('message' => $value);

			$_SESSION['feedback'][] = $newMessage;
		}
		else
		{
			$messages = [];
			if($key and isset($_SESSION['feedback']))
			{
				foreach ($_SESSION['feedback'] as $k => $feed)
				{
					if(array_key_exists($key, $feed))
					{
						$messages[] = $feed[$key];
						unset($_SESSION['feedback'][$k]);
					}
				}
			}
			elseif(isset($_SESSION['feedback']))
			{
				$messages = isset($_SESSION['feedback']) ? $_SESSION['feedback'] : array();
				unset($_SESSION['feedback']);
			}

			return $messages;
		}
	}

	/**
	 * Função responsável por criar paginação nas listagens da classe ViewModel no admin
	 * 
	 * @return string
	 *
	 */
	public static function pagination($params, $page, $total, $perPage)
	{
		$params 		  = $_GET;
		$params['pagina'] = $page;
		$url 			  = 'admin.php';

		$pagesList = '';

		/* PREV */
		if($total)
		{
			$params['pagina'] = ($params['pagina'] > 1) ? ($params['pagina'] - 1) : 1;
			$pagesList = '<a href="'.admin_url($url).'?'.http_build_query($params).'" class="page-title-action"><<</a>';
		}
		/* PAGES */
		for ($cont = 1; $cont <= ceil($total/$perPage); $cont++)
		{
			$params['pagina'] = $cont;
			$pagesList .= '<a href="'.admin_url($url).'?'.http_build_query($params).'" class="page-title-action">
							'.$cont.'
						</a>';
		}
		/* NEXT */
		if($total)
		{
			$params['pagina'] = ($params['pagina'] < ceil($total/$perPage)) ? ($params['pagina'] + 1) : ceil($total/$perPage);
			$pagesList .= '<a href="'.admin_url($url).'?'.http_build_query($params).'" class="page-title-action">>></a>';
		}

		return $pagesList;
	}
}