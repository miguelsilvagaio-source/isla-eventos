<header class="topo">
    <nav>
        <strong>{{ config('app.name') }}</strong>
        <a href="{{ route('inicio') }}" @if (request()->routeIs('inicio')) aria-current="page" @endif>Início</a>
        <a href="{{ route('eventos.index') }}" @if (request()->routeIs('eventos.*')) aria-current="page" @endif>Eventos</a>
    </nav>
</header>                                                               