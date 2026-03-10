# Sessão 0 - Preparação (parcial)

## Status do ambiente
- WordPress em Docker ativo em `http://localhost:8081`.
- Admin ativo em `http://localhost:8081/wp-admin/`.
- Tema ativo: `base` (`K13 Base - Comtudo Black`).

## Ajustes aplicados
- Corrigido reconhecimento do tema com criação de `content/themes/base/index.php`.
- Nome do tema atualizado em `content/themes/base/style.css`.
- Corrigido autoload do plugin de formulário para evitar erro crítico:
  - `content/themes/base/plugins/wp-mail-form/inc/Mail.php`
  - `src/plugins/wp-mail-form/inc/Mail.php`
- Ajustado `.env` para build no tema correto:
  - `MIX_THEME_NAME="K13 Base - Comtudo Black"`
  - `MIX_THEME_SLUG="base"`
- Desativadas notificações do Laravel Mix para evitar `spawn EPERM`:
  - `webpack.mix.js`
- Adicionado fallback de `IMAGE_PATH` em:
  - `src/functions.php`
  - `content/themes/base/functions.php`
- Removidas referências legadas a `scripts_version()` em templates:
  - `src/pages/head.php`
  - `src/pages/footer.php`
  - `content/themes/base/head.php`
  - `content/themes/base/footer.php`

## Dependências frontend
- Instaladas/validadas:
  - `motion`
  - `gsap`
  - `plyr`
  - `swiper`
- Baseline de imports adicionado em:
  - `src/js/base.js`
- Build executado com sucesso:
  - `npm.cmd run development`

## Plugins (inventário atual)
- Em `content/plugins`:
  - `acf-custom` (inativo)
  - `__acfpro` (inativo)
  - `akismet` (inativo)
  - `wp-mail-form` (inativo)
  - `hello.php` (inativo)
- Observação: o tema `base` já carrega cópias internas (`content/themes/base/plugins/*`) via `inc/init.php`.

## Próxima parte da Sessão 0
- Definir estratégia única de plugins (tema embutido vs `content/plugins`) para evitar duplicidade.
- Padronizar enfileiramento de assets para as próximas sessões de migração.
