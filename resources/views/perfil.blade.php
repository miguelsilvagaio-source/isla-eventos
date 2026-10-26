<!-- View Perfil -->

<h1>Perfil do Utilizador</h1>

<p><strong>Nome:</strong> {{ $nome }}</p>

@if ($ano === 2)
    <p>Está no último ano do CTeSP.</p>
@endif

<p><strong>Curso:</strong> {{ $curso }}</p>

<p><strong>Interesses ({{ count($interesses ?? []) }}):</strong></p>
<ul>
    @foreach ($interesses ?? [] as $interesse)
        <li>{{ $interesse }}</li>
    @endforeach
</ul>