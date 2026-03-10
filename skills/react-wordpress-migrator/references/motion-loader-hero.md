# Motion, Loader and Hero

## Biblioteca principal

Escolha uma estrategia clara antes de animar:

- Use GSAP como orquestrador principal quando houver timeline, ScrollTrigger, loader complexo ou reveals encadeados.
- Use Motion para entradas simples e micro animacoes em vanilla JS.
- Evite animar o mesmo elemento com Motion e GSAP ao mesmo tempo.

Se Motion falhar em um fluxo critico de loader ou hero, prefira migrar aquele fluxo inteiro para GSAP em vez de manter uma mistura instavel.

## Sequencia recomendada do loader premium

1. Animar o radial.
2. Fazer o logo central aparecer.
3. Fazer o conteudo do loader sumir com fade out.
4. Subir a cortina.
5. So depois revelar o hero.

Essa ordem evita flicker, sobreposicao e o efeito de "duas camadas brigando".

## Hero reveal

A regra e simples:

- Enquanto o loader estiver ativo, mantenha os elementos do hero bloqueados.
- Libere o hero apenas quando a cortina terminar de subir.
- Revele o banner, o fundo cinza e os elementos de texto em `fade-in-up` com pequeno `stagger`.

## Sinais de problema

Se acontecer qualquer um desses sintomas, revise a sequencia antes de mexer no CSS:

- Navbar aparece antes e depois de novo.
- Hero mostra parte do fundo antes dos textos.
- Conteudo do hero aparece enquanto o loader ainda esta saindo.
- Motion parece "nao funcionar", mas na pratica o GSAP ou classes CSS estao sobrescrevendo o estado.

## Regras praticas

- Dispare um unico evento de fim do loader, por exemplo `loader complete`.
- Prenda o `body` ou a secao hero com uma classe de bloqueio enquanto o loader existir.
- Remova a classe de bloqueio apenas no callback final da cortina.
- Aplique `fade-in-up` primeiro aos elementos estruturais do hero e depois a titulo, subtitulo e botoes.
- Respeite `prefers-reduced-motion` quando houver condicoes no projeto.

## Bibliotecas recorrentes

- `gsap` e `ScrollTrigger` para timeline e scroll.
- `motion` para entradas leves em vanilla JS.
- `swiper` para sliders.
- `plyr` para video player.

Antes de depurar a animacao, confirme tambem:

- se a biblioteca esta importada em `base.js`
- se o build recompilou
- se o elemento existe quando o script roda
- se nao ha classe CSS escondendo o elemento apos a animacao
