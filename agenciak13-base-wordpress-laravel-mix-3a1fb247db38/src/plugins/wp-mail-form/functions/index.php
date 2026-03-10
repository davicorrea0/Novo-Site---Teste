<?php
/**
 * Mail forms list functions
 *
 */
if(class_exists('acf')) {
    if (!get_field('producao', 'options')) {
        function mailForm()
        {
            add_menu_page('Mail Form', 'Mail Form', 'administrator', 'mail-form', 'mailFormView', 'dashicons-email-alt', 80);
        }

        add_action('admin_menu', 'mailForm');
    }
} else {
    function mailForm()
    {
        add_menu_page('Mail Form', 'Mail Form', 'administrator', 'mail-form', 'mailFormView', 'dashicons-email-alt', 80);
    }

    add_action('admin_menu', 'mailForm');
}
function mailFormView()
{
	$formMail = new FormMailDB();
	$attrs    = array(
		'plugin_dir_url' => WPMAILFORM_URL,
		'table_rows'     => $formMail->getFormMailsTable(),
		'admin_url'      => get_admin_url()
		);

	if(isset($_GET['feedback']))
	{
		$attrs['feedback'] = '<div id="message" class="updated notice notice-success is-dismissible below-h2">
								<p>'.urldecode($_GET['feedback']).'</p>
							</div>';
	}
	else
		$attrs['feedback'] = '';

	$viewModel = new ViewModel();
	$viewModel->setTemplate(WPMAILFORM_PATH . 'views/index.html')
			  ->setAttributes($attrs);

	echo $viewModel->replaceTemplateKeys();
}

/** ======================================= Editor settings ======================================= */

function mailFormEditor()
{
	add_menu_page('Mail Form', 'Mail Form', 'editor', 'mail-form-editor', 'mailFormEditorView', 'dashicons-email-alt', 80);
}
add_action('admin_menu', 'mailFormEditor');

function mailFormEditorView()
{
	$formMail = new FormMailDB();
	$attrs    = array(
		'plugin_dir_url' => WPMAILFORM_URL,
		'forms_fields'   => $formMail->getFormMailsFields(),
		'admin_url'      => get_admin_url()
		);

	if(isset($_GET['feedback']))
	{
		$attrs['feedback'] = '<div id="message" class="updated notice notice-success is-dismissible below-h2">
								<p>'.urldecode($_GET['feedback']).'</p>
							</div>';
	}
	else
		$attrs['feedback'] = '';

	$viewModel = new ViewModel();
	$viewModel->setTemplate(WPMAILFORM_PATH . 'views/index-editor.html')
			  ->setAttributes($attrs);

	echo $viewModel->replaceTemplateKeys();
}
