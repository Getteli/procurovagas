<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<li class="breadcrumb-item active-bc" aria-current="page">Sobre nós</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1 class="display-6">O que é <b>ProcuroVagas</b> ?</h1>
		<div class="container p-5 justify">
			<h2 class="subtitle">
				O <b>ProcuroVagas</b> vem a ser uma ponte que tem o prazer de ajudar a diminuir o desemprego no Brasil.
			</h2>
			<p>
				Nossa missão é unir as diversas oportunidades de emprego disponibilizadas pela internet e exibi-las em <b>um só lugar</b>, para facilitar a vida de todos os usuários (tanto experiêntes quanto pessoas que não saibam).
			</p>
			<p>
				Procure pela sua vaga de emprego dos seus sonhos, procure seu primeiro estágio, ache aquela vaga de meio-periodo, esteja por dentro das melhores vagas da sua área. Busque, ache, confirme. Nosso objetivo é que o usuário entre em nossa plataforma e saia dele com diversas oportunidades de emprego.
			</p>
			<p>
				Segundo o site <b>agencia Brasil</b>:
				<figure>
					<blockquote class="blockquote">
						<p>
							A taxa de desemprego no país ficou em <b>14,6%</b> no trimestre encerrado em maio deste ano, segundo dados divulgados hoje (30) pelo Instituto Brasileiro de Geografia e Estatística (IBGE). O índice é estável, em termos estatísticos, em relação ao trimestre imediatamente anterior (encerrado em fevereiro deste ano): 14,4%.
						</p>
					</blockquote>
					<figcaption class="blockquote-footer">
					fonte: <a href="https://agenciabrasil.ebc.com.br/economia/noticia/2021-07/taxa-de-desemprego-fica-em-146-no-trimestre-encerrado-em-maio" target="_blank">agenciabrasil.ebc.com.br/taxa-de-desemprego-fica-em-146-no-trimestre</a>
					<br>texto original <cite title="Source Title">AgenciaBrasil</cite>
					</figcaption>
				</figure>
				. O time da plataforma <a href="{{route('index')}}" target="_blank">procuroVagas</a> acredita que é um dever de todos, ajudar a abaixar este indice. Fornecendo mais oportunidades e divulgando-as de forma mais clara para todos. Conseguir fazer esta ponte, apresentar todas as vagas e juntar todos as pessoas que estejam a procura de uma vaga, é o dever da nossa plataforma.
			</p>
			<p>
				As vagas aqui registradas foram buscadas pela internet, organizadas em diversas categorias, tipos, estados e cidades. E outras vagas podem ser criadas aqui mesmo através da página <a href="{{route('criarvaga')}}" target="_blank">Cadastre sua vaga</a>, onde armazenaremos a sua vaga até o tempo que você desejar. Nós não exibimos dados pessoais nem armazenamos senhas ou quaisquer outro tipo de dado sensivel. Em caso de dúvidas, leia nossa <a href="{{route('politicaeprivacidade')}}" target="_blank">Política e privacidade</a>.
			</p>
			<p><b>OBS</b>: caso a sua vaga esteja listada e você não deseja que ela apareça por favor entre em contato pelo formulário abaixo.</p>
			<div class="container p-5">
				<form class="row g-3 row-cols-1 d-flex justify-content-center" action="">
					<div class="col-md-4 col-sm-12">
						<label for="inputEmail" class="form-label">E-mail</label>
						<input type="email" id="inputEmail" class="form-control" placeholder="seuemail@...">
					</div>
					<div class="col-md-4 col-sm-12">
						<label for="inputName" class="form-label">Nome</label>
						<input type="email" id="inputname" class="form-control" placeholder="seu nome">
					</div>
					<div class="col-md-8 col-sm-12">
						<label for="inputTextArea">Descreva a sua vaga</label>
						<textarea id="inputTextArea" class="form-control"></textarea>
					</div>
					<div class="col-md-8 col-sm-12 d-flex justify-content-end">
						<button class="btn btn-outline-dark" type="submit"><i class="bi-envelope"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

<!-- page active -->
@section('sobre') active @endsection