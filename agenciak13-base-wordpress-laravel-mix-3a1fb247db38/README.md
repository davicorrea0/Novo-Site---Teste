# README #

Instruções básicas para instalação

### Wordpress base para projetos ###

### Passos necessários  ###

* Instalar dependências do PHP:

```
composer install

```

* Instalar dependências do NPM:

```
npm install

```

* Criar aquivo `.env` com as configurações do projeto:

```
MIX_THEME_NAME="K13"    // Nome do tema.
MIX_THEME_SLUG="K13"    // Nome da pasta que será gerado o tema.
DB_NAME="K13"           // Nome do banco de dados.
DB_USER="root"          // Usuário do banco de dados.
DB_PASSWORD="secret"    // Senha do Banco de dados.
DB_HOST="K13-database"  // Host do Banco de dados.

```

* Copiar e renomear o arquivo `wp-config.sample.php` para `wp-config.php`.

* No arquivo `wp-config.php`, substituir as linhas abaixo pelas chaves geradas em: https://api.wordpress.org/secret-key/1.1/salt

```
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
```

* Antes de acessar o painel do Wordpress, é necessário gerar uma build do tema com um dos seguintes comandos:

```
npm run dev         // Gera uma build para rodar no desenvolvimento

npm run watch       // Ouve alterações durante o desenvolimento

npm run production  // Gera uma build para rodar em produção
```

* No painel do wordpress, na opção "Aparência" > "Temas" selecionar o tema gerado.