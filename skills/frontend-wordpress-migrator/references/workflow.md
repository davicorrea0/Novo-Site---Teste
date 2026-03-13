# Workflow

## Objetivo

Usar este fluxo quando o pedido for pegar um site ou design de origem e reproduzi-lo em WordPress sem perder identidade visual, estrutura, SVGs, animacoes e pontos de edicao.

## Checklist inicial

- Identificar a origem principal: React, Vite, Next.js, HTML/CSS/JS puro ou Figma via MCP.
- Se houver codigo, levantar dependencias de UI, video, slider e motion com `rg` em `package.json`, `src/`, `app/`, `components/` ou pastas equivalentes.
- Se a origem for HTML estatico, mapear paginas, includes, scripts globais, formularios, SVGs e assets locais.
- Se a origem for Figma, capturar contexto com MCP, incluindo screenshot, hierarquia, componentes, variaveis e possiveis pistas de prototipo.
- Mapear rotas, componentes ou frames centrais, secoes da home, paginas internas e dados mockados ou texto final.
- Identificar cedo quais secoes devem virar componentes dinamicos conectados ao ACF e quais podem permanecer estaticas.
- Identificar qual e a forma do tema WordPress alvo: tema customizado classico, tema com pipeline de build, ou variante como K13.
- Confirmar que WordPress abre no navegador, ou que ao menos o tema alvo consegue ser compilado e servido no ambiente local.
- Confirmar que a build do tema gera assets sem erro e escreve nos caminhos esperados.

## Ordem recomendada

1. Preparar ambiente, URL local e tema ativo.
2. Inventariar plugins, helpers e bootstrap do tema.
3. Auditar a origem e separar o que vira template inteiro, parcial, asset ou campo editavel.
4. Converter header, footer e wrappers globais.
5. Converter home e paginas estaticas principais.
6. Mapear conteudo editavel com ACF, options pages, flexible content, CPTs ou taxonomias.
7. Conectar secoes reutilizaveis como componentes dinamicos ou parciais alimentados por ACF.
8. Migrar interacoes, sliders, video e animacoes.
9. Validar responsividade, acentuacao, build e navegacao.

## Sessoes

Use sessoes quando o usuario quiser controle fino, checkpoints ou paradas explicitas.

Cada sessao deve:

- Ter escopo fechado.
- Entregar algo navegavel e coerente para aquele bloco.
- Terminar com validacao clara.
- Registrar o que ficou pronto e o que depende da proxima etapa.

Modelo recomendado:

- Sessao 0: ambiente, build, tema ativo, plugins e stack mapeados.
- Sessao 1: layout global, header, footer e assets compartilhados.
- Sessao 2: home e paginas estaticas.
- Sessao 3: conteudo dinamico, componentes ACF, CPTs e loops.
- Sessao 4: JavaScript comportamental, sliders, video e motion.
- Sessao 5: refinamento visual, responsividade e validacao final.

## Criterios de fidelidade

- Nao inventar novas secoes.
- Nao trocar SVGs por icones genericos sem autorizacao.
- Nao simplificar tipografia, grids ou composicao sem confirmar com o usuario.
- Nao substituir uma animacao relevante por uma transicao comum se a versao original tiver uma assinatura clara.
- Nao presumir estados ocultos, hover complexos ou transicoes longas a partir de um frame estatico do Figma sem sinal suficiente.

## Verificacoes ao final de cada etapa

- Rodar a build do tema ou a verificacao equivalente do projeto.
- Confirmar que os assets compilados foram atualizados no destino correto.
- Abrir a home e a pagina alterada.
- Verificar console, layout quebrado, carregamento duplicado, flicker e links essenciais.
- Confirmar que a versao WordPress ainda bate com a origem usada como referencia principal.
- Registrar o que ficou pronto e o que ainda depende da proxima sessao.
