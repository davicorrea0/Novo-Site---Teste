# Workflow

## Objetivo

Usar este fluxo quando o pedido for pegar um frontend React e reproduzir o site em WordPress sem perder identidade visual, estrutura, SVGs, animações e pontos de edição.

## Checklist inicial

- Localizar a origem do frontend React, Vite ou Next.js.
- Levantar dependências de UI e motion com `rg` em `package.json`, `src/`, `app/` ou `components/`.
- Mapear rotas, componentes centrais, seções da home, páginas internas e dados mockados.
- Verificar se já existe base WordPress pronta, especialmente uma estrutura K13 com `src/` e `content/themes/`.
- Confirmar que WordPress abre no navegador antes da migração.
- Confirmar que a build do tema gera assets sem erro.

## Ordem recomendada

1. Preparar ambiente e tema.
2. Inventariar plugins e definir como eles serão carregados.
3. Converter header, footer e wrappers globais.
4. Converter home e páginas estáticas.
5. Mapear conteúdo dinâmico com ACF, CPTs ou taxonomias.
6. Migrar interações e animações.
7. Validar responsividade, acentuação, build e navegação.

## Sessões

Use sessões quando o usuário quiser controle fino e paradas explícitas.

Cada sessão deve:

- Ter escopo fechado.
- Entregar algo navegável e completo para aquele bloco.
- Terminar com validação clara.
- Não avançar para a próxima sem autorização.

Modelo recomendado:

- Sessão 0: ambiente, Docker, build, tema ativo, plugins inventariados.
- Sessão 1: layout global, header, footer e assets.
- Sessão 2: home e páginas estáticas.
- Sessão 3: conteúdo dinâmico, ACF, CPTs e loops.
- Sessão 4: JavaScript comportamental, sliders, video e motion.
- Sessão 5: refinamento visual, responsividade e validação final.

## Critérios de fidelidade

- Não inventar novas seções.
- Não trocar SVGs por ícones genéricos.
- Não simplificar tipografia, grids ou composição sem confirmar com o usuário.
- Não substituir uma animação relevante por uma transição comum se a versão React tiver uma assinatura clara.

## Verificações ao final de cada etapa

- Rodar build do tema.
- Confirmar que os assets compilados foram atualizados.
- Abrir a home e a página alterada.
- Verificar console, layout quebrado, carregamento duplicado e flicker.
- Registrar o que ficou pronto e o que depende da próxima sessão.
