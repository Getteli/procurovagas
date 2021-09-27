<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<li class="breadcrumb-item active-bc" aria-current="page">Como procurar uma vaga ?</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1 class="display-6">Procurar emprego</h1>
		<div class="container p-5 justify">
			<h2 class="subtitle">
				subtitle
			</h2>
			<p>
				paragrafo
			</p>
		</div>
	</div>
@endsection

<!-- page active -->
@section('comofunciona') active @endsection