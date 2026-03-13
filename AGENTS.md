## Skills

A skill is a set of local instructions to follow that is stored in a `SKILL.md` file. Below is the list of skills that can be used in this workspace.

### Available skills

- frontend-wordpress-migrator: Migra interfaces para temas WordPress customizados a partir de React, Vite, Next.js, HTML/CSS/JS puro ou layouts vindos do Figma via MCP, preservando layout, componentes, SVGs, animacoes e conteudo editavel. Use quando o pedido envolver converter um site ou design em templates PHP ou parciais, modelar secoes como componentes dinamicos conectados ao ACF, validar a stack do tema antes da migracao, ou adaptar o fluxo para variantes como K13 com Laravel Mix quando elas realmente existirem. (file: C:/Users/Davi - Hotel Pra Hoj/Documents/Novo Site - Teste/skills/frontend-wordpress-migrator/SKILL.md)

### How to use skills

- Se o pedido for migrar ou replicar em WordPress um frontend React, Vite, Next.js, HTML/CSS/JS puro ou um layout vindo do Figma via MCP, use `frontend-wordpress-migrator` antes de propor uma abordagem do zero.
- Leia primeiro o `SKILL.md` e so depois carregue apenas as referencias necessarias para o tipo de origem e para a stack detectada.
- So carregue a referencia de K13 ou Laravel Mix quando o projeto realmente seguir essa estrutura.
- Se o pedido for apenas ajustar esta base K13 ja existente, sem migracao a partir de outra origem, trabalhe direto na stack atual e use a skill apenas quando ela realmente ajudar.

## Workspace Context

- O workspace raiz e um ponto de coordenacao. O projeto WordPress real fica em `agenciak13-base-wordpress-laravel-mix-3a1fb247db38/`.
- Esta base usa Laravel Mix com codigo-fonte do tema em `src/` e tema ativo compilado em `content/themes/base/`.
- O slug atual do tema e `base`. Evite renomear tema, slug ou volumes Docker sem pedido explicito.
- O WordPress local roda em Docker em `http://localhost:8081` e o admin em `http://localhost:8081/wp-admin/`.
- O historico de trabalho fica em `agenciak13-base-wordpress-laravel-mix-3a1fb247db38/docs/sessoes/`.
- A ultima sessao registrada e `sessao-05.md`, marcada como finalizada. Nao avance para escopo novo sem confirmacao explicita do usuario.

## Preferred Workflow

- Para layout, comportamento e estilos do tema, edite primeiro arquivos em `agenciak13-base-wordpress-laravel-mix-3a1fb247db38/src/`.
- So altere `content/themes/base/` quando o arquivo existir apenas no tema compilado ou quando a tarefa exigir mudanca no destino final montado pelo Docker.
- Para a home, os arquivos mais provaveis sao `src/pages/front-page.php`, `src/scss/app.scss` e `src/js/base.js`.
- Antes de mexer em plugins, confirme se a mudanca pertence a `content/plugins/` ou as copias embutidas em `content/themes/base/plugins/` para evitar duplicidade.
- Preserve a estrutura K13/Laravel Mix atual. Nao troque pipeline, pastas-base ou estrategia de assets sem solicitacao explicita.

## Commands That Fit This Repo

- Rode comandos de build dentro de `agenciak13-base-wordpress-laravel-mix-3a1fb247db38/`.
- Build de desenvolvimento: `npm.cmd run development`
- Watch: `npm.cmd run watch`
- Build de producao: `npm.cmd run production`
- Subir o ambiente local: `docker compose up -d`
- Ler logs recentes do WordPress: `docker compose logs --tail 80 wordpress`

## Validation

- Depois de mexer no frontend ou no tema, prefira validar com build concluido, resposta HTTP do front e resposta HTTP do admin quando fizer sentido.
- Validacoes uteis neste projeto:
  - `Invoke-WebRequest http://localhost:8081`
  - `Invoke-WebRequest http://localhost:8081/wp-admin/`
  - `docker compose logs --since 3m wordpress | Select-String "PHP Warning|PHP Fatal|Parse error|PHP Notice|php:error|php:warn"`
- Em tarefas maiores, registre o fechamento em `docs/sessoes/` com objetivo, arquivos alterados, validacao executada e limites da proxima etapa.
