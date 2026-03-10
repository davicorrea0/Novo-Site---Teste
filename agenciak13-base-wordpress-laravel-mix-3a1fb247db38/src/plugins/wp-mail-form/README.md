WP Mail Form
============
Plugin WordPress para automatizar formulários que enviam email usando a WP Mail

**Detalhes**

*   Criar o `HTML` do seu formulário com o atributo `action` vazio
*   Crie os campos usando o mesmo prefixo definido no cadastro do formulário (exceto campos do tipo `file`)  
    **Exemplo com prefixo `contact`:** `<input name="contact[field]">`
*   Criar o campo `redirect` do tipo `hidden` em cada formulário (por padrão irá redirecionar para a **Página inicial**)
*   Criar o campo `subject` (assunto) em cada formulário (por padrão o assunto do email será **Título do formulário - Título do Blog Wordpress**)
*   Recuperando mensagens de **feedback**:  

    O **código PHP** `FormMailHelper::feedback('prefix')` retorna o array com as mensagens apenas com o prefixo de cada formulário.  

    Imprimindo mensagens (exemplo com prefixo `contact`):

        <?php foreach(FormMailHelper::feedback('contact') as $message): ?>
        	<?php echo $message ?>
        <?php endforeach ?>

**Google reCaptcha**
*   Para recuperar a `site key` do **Google reCaptcha** no site é necessário usar o código PHP `get_option('g_recaptcha_site_key')`
*   Para recuperar a `secret key` do **Google reCaptcha** no site é necessário usar o código PHP `get_option('g_recaptcha_secret_key')`

**Template**
*   As chave extra que pode ser usada é `template_url` que é o caminho do tema `get_bloginfo('template_url')`
*   As chaves a serem substituídas dinamicamente devem estar exatamente igual ao que foi definido no atributo `name` dos campos do formulário
*   **Exemplo:**

        <div style="width:100%;">
        	<div>
        		<h2>
        			{{subject}}
        		</h2>
        		<p><strong>Nome:</strong> {{name}}</p>
        		<p><strong>E-mail:</strong> {{email}}</p>
        		<p><strong>Telefone:</strong> {{phone}}</p>
        		<p><strong>Mensagem:</strong> {{message}}</p>
        	</div>
        </div>
