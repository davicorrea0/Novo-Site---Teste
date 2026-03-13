# Source Audit

## Objetivo

Usar esta referencia para descobrir rapidamente qual e a melhor estrategia de migracao conforme a origem do site.

## Origem em React, Vite ou Next.js

- Localizar rotas, layouts, componentes, providers e fontes de dados.
- Usar `rg` em `package.json`, `src/`, `app/`, `components/` e `public/` para identificar bibliotecas de UI, motion, slider, video e formularios.
- Separar o que e estrutura global, o que e secao reutilizavel e o que e conteudo hard-coded.
- Mapear imagens, SVGs inline, icones e assets referenciados por import.

## Origem em HTML, CSS e JS puros

- Mapear arquivos HTML por pagina e identificar includes, duplicacoes de header, footer e secoes recorrentes.
- Descobrir quais estilos sao globais e quais sao especificos por pagina.
- Identificar scripts globais, plugins de terceiros, mascaras, validacoes de formulario e sliders.
- Levantar assets locais e caminhos relativos antes de mover markup para WordPress.

## Origem em Figma via MCP

- Usar `mcp__figma__get_design_context` como ferramenta principal quando o node da interface estiver disponivel.
- Complementar com `mcp__figma__get_metadata` quando precisar entender hierarquia, nomes de camadas e repeticoes estruturais.
- Usar `mcp__figma__get_variable_defs` para mapear cores, espacamentos e tokens relevantes quando isso ajudar a alinhar o tema.
- Usar screenshot do node para validar fidelidade visual antes de ajustar detalhes finos no codigo.
- So assumir animacoes, hover states ou estados dinamicos quando houver prototipo, nomeacao clara ou instrucao explicita do usuario.

## Saida esperada da auditoria

Depois da auditoria, registrar no minimo:

- qual e a origem principal usada como referencia
- quais paginas ou frames viram templates completos
- quais blocos viram parciais reutilizaveis
- quais blocos devem virar componentes dinamicos conectados ao ACF
- quais partes devem ser editaveis via ACF, options page, flexible content, CPT ou taxonomia
- quais assets e comportamentos precisam de migracao fiel
