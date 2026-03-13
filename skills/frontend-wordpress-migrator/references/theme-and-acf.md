# Theme and ACF

## Ler a estrutura antes de migrar

Em projetos WordPress customizados, o mais importante e descobrir cedo como o tema organiza:

- templates principais como `front-page.php`, `page.php`, `single.php` e `archive.php`
- parciais em pastas como `template-parts/`, `partials/` ou `src/pages/partials/`
- bootstrap em `functions.php`, `inc/`, `app/` ou estrutura equivalente
- assets em `assets/`, `src/`, `resources/` ou outra pasta de origem
- build em Vite, Webpack, Laravel Mix ou sem pipeline algum

Se o projeto seguir a base K13 com Laravel Mix, leia tambem `k13-laravel-mix.md`.

## Regra de conteudo

Quando o usuario pedir conteudo editavel, use ACF por padrao, a menos que o projeto ja adote outro sistema claramente dominante.
Quando a interface tiver blocos reutilizaveis, trate cada bloco como um componente dinamico conectado ao ACF, nao como markup isolado perdido dentro da pagina.

Mapeie assim:

- Hero com imagem, titulo, subtitulo, CTA e variacoes: `group` ou campos simples
- Cards, segmentos, logos, itens de galeria e repeticoes previsiveis: `repeater`
- Paginas com ordem variavel de blocos ou varios modulos reutilizaveis: `flexible content` ou estrutura equivalente da base
- Dados globais de header, footer, contato e redes: options page
- Areas com pagina propria por item: CPT e relacionamentos
- Variacoes por taxonomia, categoria ou agrupamento editorial: taxonomias e termos

## Escolher onde registrar os campos

- Se o projeto ja usa `acf_add_local_field_group`, continue nesse padrao.
- Se o projeto usa `acf-json`, respeite esse fluxo em vez de introduzir uma segunda estrategia.
- Se houver helpers, wrappers ou factories proprias para ACF, reaproveite-os.
- Nao introduza plugins, builders ou geradores paralelos sem necessidade real.

## Regras de modelagem

- Leia a origem real antes de definir os campos, seja componente React, secao HTML ou frame do Figma. O modelo de dados deve nascer da interface final.
- Evite despejar HTML inteiro em WYSIWYG quando a interface tem estrutura repetivel previsivel.
- Preserve nomes de classes importantes quando o CSS ou o JS depende deles.
- Crie fallbacks quando um campo for opcional para evitar warnings, espacamentos quebrados ou CTAs vazios.

## Componentes dinamicos conectados ao ACF

- Para cada secao reutilizavel, defina um componente ou parcial PHP claro e um conjunto de campos ACF que alimenta esse bloco.
- Prefira passar dados estruturados para o componente em vez de buscar campos soltos por toda a view.
- Use `group` quando o bloco tiver poucos campos fixos.
- Use `repeater` quando o bloco repetir cards, logos, features, galerias ou itens similares.
- Use `flexible content` quando a pagina puder reordenar ou combinar modulos diferentes.
- Mantenha a responsabilidade separada: template de pagina monta a sequencia, componente renderiza o bloco, ACF fornece os dados.
- Se o projeto ja tiver helpers para resolver campos ou renderizar layouts, reuse esse padrao em vez de inventar outro.

## Templates e parciais

Ao converter a interface de origem:

- Mova a estrutura para templates PHP, parciais ou `template-parts` do tema atual.
- Troque listas da origem por loops PHP claros quando o bloco for repetivel.
- Use `get_field()`, `have_rows()`, helpers locais e `get_template_part()` de acordo com o padrao do tema.
- Mantenha o markup o mais fiel possivel antes de otimizar.
- Se a origem for Figma, derive o markup de componentes, grupos e repeticoes consistentes. Nao invente wrappers sem necessidade.
- Evite paginas gigantes com dezenas de campos lidos em linha. Quebre em componentes dinamicos conectados ao ACF quando houver blocos distintos.

## Checklist de robustez

- Confirmar fallback quando um campo ACF vier vazio.
- Escapar links, textos e atributos corretamente.
- Garantir que imagens, links e arrays ACF sejam validados antes do uso.
- Validar se o admin consegue editar os blocos sem tocar no codigo.
- Validar se os componentes continuam renderizando mesmo quando um layout ACF vier incompleto ou fora da ordem esperada.
- Validar se a build, quando existir, escreveu o resultado no tema correto depois da mudanca.
