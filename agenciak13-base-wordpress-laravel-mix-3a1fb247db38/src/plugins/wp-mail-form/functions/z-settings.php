<?php
/**
 * Mail forms settings
 * 
 */
function mailFormSettings()
{
	add_submenu_page('mail-form', 'Configurações', 'Configurações', 'administrator', 'mail-form-settings', 'mailFormSettingsView');
}
add_action('admin_menu', 'mailFormSettings');

function mailFormSettingsView()
{
	$attrs    = array(
		'feedback'		 => '',
		'plugin_dir_url' => WPMAILFORM_URL,
		'admin_url'      => get_admin_url(),

		'site_key'       => get_option('g_recaptcha_site_key'),
		'secret_key'     => get_option('g_recaptcha_secret_key')
		);

	if(isset($_GET['feedback']))
	{
		$attrs['feedback'] = '<div id="message" class="updated notice notice-success is-dismissible below-h2">
								<p>'.urldecode($_GET['feedback']).'</p>
							</div>';
	}

	$viewModel = new ViewModel();
	$viewModel->setTemplate(WPMAILFORM_PATH . 'views/settings.html')
			  ->setAttributes($attrs);

	echo $viewModel->replaceTemplateKeys();
}
