# K13 Laravel Mix Variant

## Quando usar esta referencia

Use esta referencia apenas quando o repositorio seguir a base `agenciak13-base-wordpress-laravel-mix-*` ou outra estrutura claramente equivalente.

## Estrutura esperada

Nesse formato, o normal e:

- `src/` conter o codigo fonte do tema
- `content/themes/<slug>/` receber o resultado compilado
- `src/pages/` guardar templates como `front-page.php`, `page.php`, `single-*.php` e parciais
- `src/inc/` concentrar bootstrap do tema, filtros, actions, helpers e post types
- `src/js/base.js` centralizar sliders, loader, hero e comportamentos globais
- `src/scss/app.scss` concentrar a maior parte do estilo

## Arquivos que definem a base

- `.env` define `MIX_THEME_NAME` e `MIX_THEME_SLUG`
- `webpack.mix.js` define a estrategia de copia e build do tema
- `src/inc/init.php` normalmente controla plugins embutidos e carregamento global
- `src/functions.php` costuma ser o bootstrap do tema fonte

Se o tema nao aparecer no admin, verifique primeiro esses arquivos antes de mexer em templates.

## Plugins

Verifique cedo se o projeto usa duas fontes de plugins:

- `content/plugins/`
- `src/plugins/` ou `content/themes/<slug>/plugins/`

Nao ative tudo cegamente. Primeiro descubra quem faz autoload em `src/inc/init.php`.

Na base K13, e comum encontrar:

- `__acfpro`
- `acf-custom`
- `__rocketplug`
- `wp-mail-form`

Trate o que esta em `src/plugins/` como fonte editavel quando o repositorio seguir esse padrao.

## Regras praticas

- Trabalhe em `src/` como fonte editavel principal.
- Valide se o build copiou o resultado para `content/themes/<slug>/` depois de cada etapa importante.
- Reuse helpers e conventions existentes antes de inventar outra camada administrativa.
- Considere `src/js/base.js` e `src/scss/app.scss` como centros de integracao quando o projeto ainda seguir esse desenho.
