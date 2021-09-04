<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
		<title>Procuro Vagas</title>
	</head>
	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark black-90">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{route('index')}}">
						<img src="{{ asset('images/procurovagasnegativo.png') }}" alt="Procurar vagas" width="45" height="45">
						ProcuroVagas
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link @yield('index')" aria-current="page" href="{{route('index')}}" data-id="1">Início</a>
							</li>
							<li class="nav-item">
								<a class="nav-link @yield('sobre')" href="{{route('sobre')}}" data-id="2">Sobre nós</a>
							</li>
							<li class="nav-item">
								<a class="nav-link @yield('comofunciona')" href="{{route('comofunciona')}}" data-id="3">Como Funciona ?</a>
							</li>
							<li class="nav-item">
								<a class="nav-link @yield('criarvaga')" href="{{route('criarvaga')}}" data-id="4">Cadastre sua vaga</a>
							</li>
						</ul>
						<form class="d-flex">
							<input class="form-control me-2" type="search" placeholder="Procurar Vagas" aria-label="Search">
							<button class="btn btn-outline-light" type="submit"><i class="bi-search"></i></button>
						</form>
					</div>
				</div>
			</nav>
			
			<div class="container" id="main">
				<!-- conteudo -->
				@yield('content')
			</div>

			<footer class="text-center text-lg-start navbar-dark black-90 text-muted">
				<!-- Section: Links  -->
				<section class="">
					<div class="container text-center text-md-start mt-5">
						<!-- Grid row -->
						<div class="row mt-3">
							<!-- Grid column -->
							<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 div-align-p">
								<!-- Content -->
								<h6 class="text-uppercase fw-bold mb-4"> Procuro Vagas </h6>
								<p> Encontre a vaga ideal para você !</p>
								<p>
									vagas em todo o brasil, de todos os tipos. Grátis e sem cadastro, aproveite e boa sorte !
									<hr>
									<strong>obs</strong>: Não armazenamos quaisquer dados pessoais. Apenas fazemos a ponte entre quem procura uma vaga e quem oferece o emprego Leia nossa <a href="{{route('politicaeprivacidade')}}">politica</a>
								</p>
							</div>

							<!-- Grid column -->
							<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 menu-f">
								<!-- Links -->
								<h6 class="text-uppercase fw-bold mb-4">
									Menu / mapa do site
								</h6>
								<p>
									<a href="{{route('index')}}" class="text-reset @yield('index')" data-id="1">Início</a>
								</p>
								<p>
									<a class="text-reset @yield('sobre')" href="{{route('sobre')}}" data-id="2">Sobre nós</a>
								</p>
								<p>
									<a class="text-reset @yield('comofunciona')" href="{{route('comofunciona')}}" data-id="3">Como Funciona</a>
								</p>
								<p>
									<a class="text-reset @yield('criarvaga')" href="{{route('criarvaga')}}" data-id="4">Cadastre sua vaga</a>
								</p>
								<p>
									<a class="text-reset @yield('politicaeprivacidade')" href="{{route('politicaeprivacidade')}}" data-id="5">Política e privacidade</a>
								</p>
							</div>
						</div>
					</div>
				</section>

				<!-- Copyright -->
				<div class="text-center p-4">
					© <?= env('APP_YEAR') ?> Direitos Reservados:
					<a class="fw-bold" href="https://procurovagas.com.br/">procurovagas.com.br</a>
				</div>
				<div class="text-center p-4">
					versão <strong><?= env('APP_VERSION') ?></strong>
				</div>
			</footer>
		</div>
	<!-- scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<script src="{{ asset('js/app.js') }}"></script>