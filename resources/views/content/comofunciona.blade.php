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
				Buscar uma vaga
			</h2>
			<p>
				Você pode pesquisar uma vaga de emprego seja ela:
				<ul>
					<li>Integral</li>
					<li>Meio periodo</li>
					<li>Jovem aprendiz</li>
					<li>e muito mais !</li>
				</ul>
				Além de outros paramêtros para a sua busca.
			</p>
			<p>Após escolher uma vaga, clique no card com a vaga desejada. Você poderá ler sobre a vaga, com detalhes sobre a empresa, descrição, o que eles buscam para preencher aquela vaga e outros detalhes que podem ser importantes.</p>
		</div>
		<div class="container p-5 pt-2 justify">
			<h2 class="subtitle">
				Candidatar-se
			</h2>
			<p>
				Feito a busca e a vaga que você tanto deseja for escolhida, está na hora de se Candidatar ! <br>
				Agora você pode ter 2 opções:
				<ul>
					<li> <a href="#vialink">Clicar no link que levará para o anúncio da vaga</a> </li>
					<li> <a href="#viaformulario">Enviar seu CV pelo formulário para o empregador</a> </li>
				</ul>
			</p>
			<p>
				<h3 id="vialink" class="subtitle">Via link</h3>
				No final do anuncio da vaga escolhida, clique no botão escrito <b>CANDIDATAR</b>.
			</p>
			<p>
				<h3 id="viaformulario" class="subtitle">Via Formulário</h3>
				No final do anuncio da vaga escolhida, será exibido um formulário onde você poderá digitar uma mensagem E anexar o seu Currículo.
				Feito isso, clique em enviar e aguarde sua resposta pelos meios de comunicação citados no seu CV.
			</p>
		</div>
	</div>
@endsection

<!-- page active -->
@section('comofunciona') active @endsection