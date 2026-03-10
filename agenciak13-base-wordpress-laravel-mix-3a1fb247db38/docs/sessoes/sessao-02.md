# Sessão 2 - Páginas estáticas e templates

## Escopo executado
- Conversão de templates para fluxo WordPress com loop (`have_posts()`, `the_post()`, `the_content()`).
- Atualização da `front-page.php` para conteúdo dinâmico da página inicial.
- Criação de `page.php` para páginas padrão.
- Revisão de `page-example.php` e `404.php`.

## Arquivos alterados
- `src/pages/front-page.php`
- `src/pages/page.php` (novo)
- `src/pages/page-example.php`
- `src/pages/404.php`

## O que mudou na prática
- Home:
  - Hero com fallback dinâmico (título, resumo, imagem destacada).
  - Bloco principal com `the_content()`.
  - Bloco de destaques com `WP_Query` para posts.
  - Bloco de segmentos com `WP_Query` para CPT `itens`.
- Página padrão:
  - Loop completo com renderização de título e conteúdo.
- Template de exemplo:
  - Loop completo com metadado de data.
- 404:
  - Estrutura Bootstrap e CTA para home.

## Build e validação
- Build executado com sucesso: `npm.cmd run development`.
- Validações HTTP:
  - `HOME_STATUS=200`
  - `PAGE2_STATUS=200`
  - `NOTFOUND_STATUS=404`
  - `ADMIN_STATUS=200`
- Logs recentes do container sem novo erro fatal após correção do parse.

## Observações
- O parser do `mix-html-builder` exige fechamento explícito de blocos PHP finais (`?>`) nos templates alterados.
