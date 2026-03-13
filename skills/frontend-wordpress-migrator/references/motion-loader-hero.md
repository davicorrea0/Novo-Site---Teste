# Motion, Loader and Hero

## Biblioteca principal

Escolha uma estrategia clara antes de animar:

- Use GSAP como orquestrador principal quando houver timeline, ScrollTrigger, loader complexo ou reveals encadeados.
- Use Motion ou a biblioteca equivalente do projeto apenas para entradas simples e micro animacoes.
- Evite animar o mesmo elemento com duas bibliotecas ao mesmo tempo.

Se a biblioteca original do frontend nao existir no tema WordPress final, recrie o comportamento com uma estrategia unica em vez de misturar adaptacoes instaveis.
Se a origem for um frame estatico do Figma, trate motion como opcional ate haver pistas claras de prototipo, naming ou pedido explicito do usuario.

## Sequencia recomendada para loader e hero

1. Animar o elemento central do loader.
2. Encerrar o conteudo do loader com fade out.
3. Liberar a cortina ou overlay de saida.
4. So depois revelar o hero.

Essa ordem evita flicker, sobreposicao e o efeito de "duas camadas brigando".

## Hero reveal

A regra principal:

- Enquanto o loader estiver ativo, mantenha os elementos do hero bloqueados.
- Libere o hero apenas quando a transicao final do loader terminar.
- Revele background, media e texto com `stagger` curto e ordem previsivel.

## Sinais de problema

Se acontecer qualquer um desses sintomas, revise a sequencia antes de mexer no CSS:

- Navbar aparece cedo demais e depois reaparece.
- Hero mostra fundo antes do texto ou antes da mascara terminar.
- Conteudo do hero aparece enquanto o loader ainda esta saindo.
- A animacao parece "nao funcionar", mas na pratica outra biblioteca ou classe CSS esta sobrescrevendo o estado.
- O layout do Figma esta fiel, mas a versao codificada parece "animada demais" sem base no design original.

## Regras praticas

- Dispare um unico evento de fim do loader.
- Prenda `body` ou a secao hero com uma classe de bloqueio enquanto o loader existir.
- Remova a classe de bloqueio apenas no callback final da transicao.
- Revele primeiro os elementos estruturais e depois titulo, subtitulo e botoes.
- Respeite `prefers-reduced-motion` quando o projeto ja considerar acessibilidade.

## Bibliotecas recorrentes

- `gsap` e `ScrollTrigger` para timeline e scroll.
- `motion` ou equivalente para entradas leves.
- `swiper` para sliders.
- `plyr` para video player.

Antes de depurar a animacao, confirme tambem:

- se a biblioteca esta importada no ponto de entrada certo
- se a build recompilou
- se o elemento existe quando o script roda
- se nao ha classe CSS escondendo o elemento apos a animacao
