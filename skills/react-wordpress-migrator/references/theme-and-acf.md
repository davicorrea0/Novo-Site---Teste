# Theme and ACF

## Estrutura K13

Em projetos nesse formato, o normal e:

- o repositorio nascer de uma base como `agenciak13-base-wordpress-laravel-mix-*`
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
- `src/functions.php` e o ponto de bootstrap do tema fonte

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

## Regra de conteudo

Quando o usuario pedir conteudo editavel, use ACF por padrao.

Mapeie assim:

- Hero com imagem, titulo, subtitulo, CTA e variacoes: `group` ou campos simples
- Cards, segmentos, marcas, itens de galeria: `repeater`
- Dados globais de header e footer: options page
- Blocos com endereco, telefone, links sociais e mapas: options page ou group
- Areas relacionais: CPT + relationship quando houver pagina propria por item

## Implementacao

- Registre grupos de campos em PHP quando o projeto ja trabalha com campos locais
- Reaproveite `acf_add_local_field_group` e options pages se a base ja tiver esse padrao
- Prefira manter os campos na mesma camada da base K13, sem introduzir outro plugin ou gerador de ACF em paralelo
- Leia o componente React original antes de definir os campos. O modelo de dados deve nascer da interface real
- Evite despejar HTML inteiro em WYSIWYG quando a interface tem estrutura repetivel previsivel

## Templates

Ao converter componentes React:

- Mova estrutura para `src/pages/*.php` ou parciais
- Troque listas React por loops PHP claros
- Use `get_field()`, `have_rows()` e funcoes auxiliares para alimentar a view
- Preserve nomes de classes importantes para nao quebrar estilo ou JS existente

## Checklist de robustez

- Confirmar fallback quando um campo ACF vier vazio
- Evitar warnings de PHP por arrays nulos
- Garantir escapagem correta para links, textos e atributos
- Validar se o admin consegue editar os blocos sem tocar no codigo
- Validar se o build copiou o resultado para `content/themes/<slug>/` depois da mudanca
