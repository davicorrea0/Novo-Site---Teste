<?php
/**
 * Mail forms list functions
 * 
 */
function mailFormTemplate()
{
	add_submenu_page('mail-form', 'Detalhes Template', 'Detalhes Template', 'administrator', 'mail-form-template', 'mailFormTemplateView');
}
add_action('admin_menu', 'mailFormTemplate');

function mailFormTemplateView()
{
	$attrs    = array(
		'plugin_dir_url' => WPMAILFORM_URL,
		'admin_url'      => get_admin_url()
		);

	$viewModel = new ViewModel();
	$viewModel->setTemplate(WPMAILFORM_PATH . 'views/template.html')
			  ->setAttributes($attrs);

	echo $viewModel->replaceTemplateKeys();
}
