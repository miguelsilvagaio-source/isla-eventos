<header class="topo">
    <strong>{{ config('app.name') }}</strong>
    <nav>
        <a href="{{ route('inicio') }}" @if (request()->routeIs('inicio')) aria-current="page" @endif>Início</a>
        <a href="{{ route('eventos.index') }}" @if (request()->routeIs('eventos.*')) aria-current="page" @endif>Eventos</a>
    </nav>
</header>