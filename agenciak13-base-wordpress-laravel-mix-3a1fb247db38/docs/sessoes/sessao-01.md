# Sessão 1 - Layout global e Header/Footer

## Escopo executado
- Estrutura global de layout migrada para PHP com Bootstrap 5.
- Header com navbar responsiva e suporte a menu WordPress (`header-menu`).
- Footer estruturado com bloco institucional.
- `index.php` convertido para loop WordPress padrão.
- Assets globais padronizados via hooks em `wp_head` e `wp_footer`.

## Arquivos principais alterados
- `src/pages/header.php`
- `src/pages/footer.php`
- `src/pages/index.php`
- `src/inc/actions/head.php`
- `src/inc/actions/footer.php`

## Build e validação
- Build executado com sucesso (`npm.cmd run development`).
- Frontend validado com `STATUS=200`.
- Admin validado com `ADMIN_STATUS=200`.
- Logs do container sem novos erros fatais após os ajustes.

## Observações técnicas
- Bootstrap 5 está carregado via CDN nesta etapa.
- Tema compilado continua em `content/themes/base` com `mix-manifest.json`.
- Estratégia de plugins duplicados (tema embutido vs `content/plugins`) fica para sessão de integração.
