<?php

/**
 * Classe desenvolvida para o uso de helpers
 *
 * @author Agência Web K13
 *
 *
 */

class Helper
{
	/**
	 * Função para paginação do Wordpress
	 *
	 */
	public static function getPagination($prettyUrl = true)
	{
		global $wp_query, $wp_rewrite;
		$pagination = array(
			'base'      => @add_query_arg('pagina', '%#%'),
			'format'    => '',
			'total'     => $wp_query->max_num_pages,
			'current'   => max(1, get_query_var('paged')),
			'prev_next' => true,
			'prev_text' => '<i class="fas fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fas fa-angle-right" aria-hidden="true"></i>',
			'show_all'  => false,
			'end_size'  => false,
			'mid_size'  => 2,
			'type'      => 'plain'
		);

		if ($prettyUrl)
			return str_replace('page/', '?pagina=', paginate_links($pagination));
		else
			return paginate_links($pagination);
	}
	public static function getAjaxPagination($page = 1, $maxPages = 1)
	{
		global $wp_query, $wp_rewrite;
		$pagination = array(
			'format'    => '',
			'total'     => $maxPages,
			'current'   => max(1, $page),
			'prev_next' => true,
			'prev_text' => '<i class="fas fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fas fa-angle-right" aria-hidden="true"></i>',
			'show_all'  => false,
			'end_size'  => false,
			'mid_size'  => 2,
			'type'      => 'plain'
		);
		return paginate_links($pagination);
	}

}

function mix($path)
{
	$content = file_get_contents(get_template_directory() . '/mix-manifest.json');
	$manifest = json_decode($content, true);

	if ($manifest && isset($manifest[$path]))
		return $manifest[$path];

	return "#";
}
