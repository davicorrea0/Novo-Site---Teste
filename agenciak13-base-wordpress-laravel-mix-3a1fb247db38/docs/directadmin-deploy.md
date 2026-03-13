# Deploy DirectAdmin

## O que subir

- Rodar `npm run production` no projeto local.
- Subir a pasta completa `content/themes/base` para `wp-content/themes/base` no servidor.
- Se quiser usar a camada de SEO com Yoast, subir tambem `content/plugins/wordpress-seo`.

## O que ativar no painel

- Ativar o tema `base` em `Aparencia > Temas`.
- Ativar o plugin Yoast SEO em `Plugins`, se ele tiver sido enviado.

## O que o tema faz sozinho

- Se o banco estiver vazio, o tema cria uma pagina `Home`.
- O tema define essa pagina como pagina inicial estatica.
- O tema vincula a `Home` ao template `front-page.php`.
- Os grupos ACF locais continuam registrados via PHP e sao sincronizados no admin.

## Checklist final

- Entrar no admin uma vez depois da subida.
- Salvar `Configuracoes > Links permanentes`.
- Conferir `Paginas > Home`.
- Conferir `Opcoes do Tema` e `SEO e GEO`.
- Se o Yoast estiver ativo, conferir os metadados da home.
