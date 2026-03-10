<?php

/**
 * Requests' controller
 *
 */

if (session_id() == '')
	session_start([
		'read_and_close' => true,
	]);

if (isset($_POST)) {
	if (isset($_POST['formmail'])) {
		global $wpdb;

		$_POST['formmail']['recipients'] = json_encode(array_map('trim', explode(',', $_POST['formmail']['recipients'])));
		if (isset($_POST['formmail']['id']))
			$wpdb->update($wpdb->prefix . 'custom_formmail', $_POST['formmail'], array('id' => $_POST['formmail']['id']));
		else
			$wpdb->insert($wpdb->prefix . 'custom_formmail', $_POST['formmail']);
		wp_redirect(get_admin_url() . 'admin.php?page=mail-form&feedback=' . urlencode('Formulário cadastrado com sucesso'));
		die;
	} else if (isset($_GET['delete_formmail'])) {
		global $wpdb;
		$wpdb->delete($wpdb->prefix . 'custom_formmail', array('id' => $_GET['form_id']));
		wp_redirect(get_admin_url() . 'admin.php?page=mail-form&feedback=' . urlencode('Formulário excluído com sucesso'));
		die;
	} else if (isset($_POST['mailformsettings'])) {
		update_option('g_recaptcha_site_key', $_POST['mailformsettings']['site_key']);
		update_option('g_recaptcha_secret_key', $_POST['mailformsettings']['secret_key']);

		wp_redirect(get_admin_url() . 'admin.php?page=mail-form-settings&feedback=' . urlencode('Configurações salvas'));
	} else if (isset($_POST['mailformfields'])) {
		global $wpdb;

		foreach ($_POST['mailformfields'] as $id => $emails) {
			$data['recipients'] = json_encode(explode(',', $emails));
			$wpdb->update($wpdb->prefix . 'custom_formmail', $data, array('id' => $id));
		}

		wp_redirect(get_admin_url() . 'admin.php?page=mail-form-editor&feedback=' . urlencode('Alterações salvas com sucesso'));
	} else {
		$formMailDB = new FormMailDB();
		$forms      = $formMailDB->getFormsArray();
		$prefix     = null;
		foreach ($_POST as $key => $post) {
			if (isset($forms[$key])) {
				$prefix = $key;
				break;
			}
		}

		if (isset($_POST[$prefix])) {
			if (FormMailValidation::reCaptcha($_POST['g-recaptcha-response'])) {
				$attrs                 = $_POST[$prefix];
				$attrs['template_url'] = get_bloginfo('template_url');

				//var_dump($attrs);exit;
				$cont        = 0;
				$attachments = array();
				foreach ($_FILES as $key => $value) {
					$files = reArrayFiles($_FILES[$key]);
					foreach ($files as $key => $value) {
						if (isset($files[$key]) and !empty($files[$key]['tmp_name'])) {
							$ext           = explode('.', $files[$key]['name']);
							$ext           = end($ext);
							$upload_dir    = wp_upload_dir();
							$fileTemp      = $upload_dir['basedir'] . '/attachment-' . $cont . '.' . $ext;
							move_uploaded_file($files[$key]['tmp_name'], $fileTemp);
							$attachments[] = $fileTemp;
							$cont++;
						}
					}
				}

				$subject = (isset($_POST[$prefix]['subject']) and strlen($_POST[$prefix]['subject'])) ? $_POST[$prefix]['subject'] : $forms[$prefix]['title'] . ' - ' . get_bloginfo('name');
				$email = isset($attrs['send_to']) ? [$attrs['send_to']] : $forms[$prefix]['recipients'];

				$mail = new Mail();


				$domain = preg_replace('#^https?://#', '', get_bloginfo('url'));
				$mail->setTemplate(get_bloginfo('template_directory') . '/' . $forms[$prefix]['template'])
					->setFrom('noreply@' . $domain)
					->setFromName($attrs['nome'])
					->setSubject($subject)
					->setAttributes($attrs)
					->setRecipients($forms[$prefix]['recipients'])
					->setAttachments($attachments)
					->send();

				if (!empty($attachments)) {
					foreach ($attachments as $fileTemp)
						unlink($fileTemp);
				}

				FormMailHelper::feedback($prefix, ["class" => "success", 'message' => $forms[$prefix]['feedback']]);
			} else
				FormMailHelper::feedback($prefix, ['class' => 'danger', 'message' => "Por favor selecione a opção 'Não sou um robô'."]);
		}
	}
}

function reArrayFiles(&$file_post)
{
	$isMulti    = is_array($file_post['name']);
	$file_count    = $isMulti ? count($file_post['name']) : 1;
	$file_keys    = array_keys($file_post);

	$file_ary    = [];
	for ($i = 0; $i < $file_count; $i++)
		foreach ($file_keys as $key)
			if ($isMulti)
				$file_ary[$i][$key] = $file_post[$key][$i];
			else
				$file_ary[$i][$key]    = $file_post[$key];

	return $file_ary;
}
