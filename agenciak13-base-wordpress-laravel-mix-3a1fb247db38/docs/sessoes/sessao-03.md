# Sessao 03 - Conteudo dinamico (CPT, actions e filters)

Data: 2026-03-10

## Objetivo

Implementar a camada dinamica em WordPress sem React:

- custom post type e taxonomia
- templates de arquivo e single
- hooks (`actions`/`filters`) para consulta e comportamento
- ajustes de estabilidade em renderizacao do tema

## Entregas realizadas

### 1) Custom Post Type e Taxonomia

Arquivo: `src/inc/post_types/example.php`

- Registro de CPT `itens`
- Registro de taxonomia `itens-categories`
- Exposicao no admin e REST API
- Suporte a `title`, `editor`, `thumbnail`, `excerpt`

### 2) Templates dinamicos

Arquivos:

- `src/pages/archive-itens.php`
- `src/pages/single-itens.php`

Implementado layout base para listagem e detalhe de `itens` usando loop nativo do WordPress.

### 3) Actions para conteudo dinamico

Arquivos:

- `src/inc/actions/ajax.php`
- `src/inc/actions/query.php`

Implementacoes:

- Endpoints REST com `permission_callback`
- `loadMoreItems()` com sanitizacao de entrada e resposta padronizada
- Tratamento defensivo em `getFeedback()`
- `pre_get_posts` para ajustar arquivo de `itens` (ordenacao e pagina)

### 4) Filters

Arquivo: `src/inc/filters/content.php`

- Ajuste de `excerpt_length`
- Ajuste de `excerpt_more`

### 5) Correcao de warnings em `head.php`

Arquivo: `src/pages/head.php`

Correcao aplicada para contextos sem `$post` global:

- uso de `get_queried_object_id()` em vez de `$post->ID`
- fallback seguro para titulo e `og:title`
- eliminacao de warnings PHP em arquivo de CPT e outros contextos sem loop principal

## Build e validacao

Comandos executados:

- `npm.cmd run development` (build concluido com sucesso)
- `Invoke-WebRequest http://localhost:8081` -> `200 OK`
- `Invoke-WebRequest http://localhost:8081/?page_id=2` -> `200 OK`
- `Invoke-WebRequest http://localhost:8081/?post_type=itens` -> `200 OK`
- `docker compose logs --since 30s wordpress | Select-String "PHP Warning|PHP Fatal|Parse error|PHP Notice|php:error|php:warn"`

Resultado:

- Nenhum warning/fatal novo nos logs apos a correcao
- Tema carregando com os templates e hooks da Sessao 03

## Status da sessao

Sessao 03 finalizada e encerrada.

Nao avancar para Sessao 04 sem confirmacao explicita.
