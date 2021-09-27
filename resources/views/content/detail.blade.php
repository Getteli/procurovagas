<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
			<li class="breadcrumb-item active-bc" aria-current="page">Nome da Vaga</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1>detalhe da vaga</h1>
		<p title="enviar">botao</p>
	</div>
@endsection