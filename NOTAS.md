# Notas PL02

## Parte D: casos limite

| URL | Código de estado |
|---|---|
| /eventos/3 | 200 (o evento existe) |
| /eventos/99 | 404 (o id é numérico, a rota entra, mas o evento não existe e o abort(404) é chamado) |
| /eventos/abc | 404 (nenhuma rota corresponde ao endereço) |

Porque é que /eventos/abc nem chega a entrar na função: a rota tem
`->whereNumber('id')`, por isso só aceita ids numéricos. Com "abc" a rota
não corresponde ao pedido, o Laravel considera que não existe nenhuma rota
para esse endereço e devolve 404 antes de executar a função.

## Parte E: query string

As ligações de filtro funcionam com `?tipo=...`. O `{{ }}` do Blade escapa o HTML,
por isso `/eventos?tipo=<h1>x` aparece como texto no código-fonte
(`&lt;h1&gt;x`) e não como um título a sério. Um tipo que não existe (xpto)
mostra a mensagem do @empty.

## Desafio: ordem das rotas

Se `/eventos/{id}` não tivesse `whereNumber('id')` e estivesse escrita antes de
`/eventos/proximos`, ao abrir `/eventos/proximos` o Laravel usava a primeira
rota que corresponde ao endereço. `{id}` aceita qualquer texto, por isso
"proximos" seria apanhado por essa rota e a rota `/eventos/proximos` nunca era
executada. Como a função tem `int $id`, o texto "proximos" não se converte
para inteiro e dava erro (500) em vez de mostrar os próximos eventos.   


## PL03 Desafio: /eventos/tipo/{tipo} vs /eventos/{id}

A rota /eventos/tipo/{tipo} tem três segmentos (eventos, tipo, valor) e a rota
/eventos/{id} tem só dois (eventos, valor). O Laravel compara o número de
segmentos, por isso um endereço como /eventos/tipo/workshop nunca corresponde a
/eventos/{id}. Além disso, o {id} tem whereNumber, que só aceita números.

# Notas PL04

## E1 · Com {{ }}
Na listagem o título aparece como texto, com o script visível e sem alert. No código-fonte está escrito &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;. O Blade converte os caracteres especiais em entidades HTML, por isso o browser mostra o código como texto e não o executa.

## E2 · Com {!! !!}
O Blade escreve o conteúdo tal como está, sem converter nada. O browser interpreta o script como código e executa o alert. Se o título viesse de um utilizador, ele podia injetar código malicioso, por isso {!! !!} nunca se usa com dados de utilizadores.

## Desafio · @push/@stack vs @section/@yield
@section/@yield é para um espaço do layout que cada página preenche uma vez (título, conteúdo). @push/@stack permite que várias views acrescentem blocos ao mesmo sítio do layout, e vão-se acumulando. Uso @section/@yield para o conteúdo principal e @push/@stack para CSS ou JS específico de uma página.