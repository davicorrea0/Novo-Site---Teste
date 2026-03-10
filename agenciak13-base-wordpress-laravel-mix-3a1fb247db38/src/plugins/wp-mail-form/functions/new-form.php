<?php
/**
 * New mail form functions
 * 
 */

function newMailForm()
{
	add_submenu_page('mail-form', 'Cadastro Formulário', 'Novo Formulário', 'administrator', 'new-mail-form', 'newMailFormView');
}
add_action('admin_menu', 'newMailForm');

function newMailFormView()
{
	$attrs = array(
		'title_page' => 'Novo',
		'edit'		 => '',
		'title'      => '',
		'prefix'     => '',
		'recipients' => '',
		'template'   => '',
		'feedback'   => 'Sua mensagem foi enviada com sucesso!'
		);

	if(isset($_GET['edit']))
	{
		$formMailDB = new FormMailDB();
		$formMail   = $formMailDB->getFormMail($_GET['id']);
		$attrs      = array(
			'edit' 		 => '<input type="hidden" name="formmail[id]" value="'.$_GET['id'].'">',
			'title_page' => 'Editar',

			'title'      => $formMail->title,
			'prefix'     => $formMail->prefix,
			'recipients' => implode(', ', json_decode($formMail->recipients, true)),
			'template'   => $formMail->template,
			'feedback'   => $formMail->feedback
			);
	}

	$attrs['admin_url']      = get_admin_url();
	$attrs['plugin_dir_url'] = WPMAILFORM_URL;

	$viewModel = new ViewModel();
	$viewModel->setTemplate(WPMAILFORM_PATH . 'views/new-form.html')
			  ->setAttributes($attrs);

	echo $viewModel->replaceTemplateKeys();
}
