<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-TKFMFD3');</script>
		<!-- End Google Tag Manager -->

		<meta charset="utf-8">
		<meta http-equiv="Content-Language" content="pt">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

		<!-- search google -->
		<META NAME="DESCRIPTION" CONTENT="Procuro Vagas - pesquise por vagas em todo o brasil e ache a vaga que você tanto precisa ! acesse agora e pesquise o emprego dos seus sonhos no seu estado">
		<META NAME="ABSTRACT" CONTENT="Procuro Vagas, Vagas de emprego, vagas de trabalho, Procuro Trabalho.">
		<META NAME="KEYWORDS" CONTENT="vagas, procuro, procuro vagas, emprego, procuro emprego, vagas de trabalho, vagas de emprego, pesquisar vagas, vagas no brasil, empregos pelo brasil">
		<META NAME="ROBOT" CONTENT="Index,Follow,Noarchive">
		<META NAME="googlebot" CONTENT="Index,Follow,Noarchive">
		<meta name="google-site-verification" content="qdIw-d1XQYRl9k5jFpfolRaRBbKErYpdQ5KE_uJ5TNM"/>
		<META NAME="LANGUAGE" CONTENT="PT">
		<!-- OG facebook -->
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="index.php">
		<meta property="og:title" content="Procuro Vagas">
		<meta property="og:site_name" content="procurovagas">
		<meta property="og:description" content="Procuro Vagas - pesquise por vagas em todo o brasil e ache a vaga que você tanto precisa ! acesse agora e pesquise o emprego dos seus sonhos no seu estado">
		<meta property="og:image" content="/images/procurovagas.png">
		<meta property="og:image:secure_url" content="https://procurovagas.com.br/images/procurovagas.png">
		<meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="150"> <!-- pixel -->
		<meta property="og:image:height" content="150"> <!-- pixel -->
		<meta property="og:type" content="website">

		<link rel="canonical" href="https://procurovagas.com.br/">
		<title>Procuro Vagas</title>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKFMFD3"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark black-90">
				<div class="container-fluid px-5">
					<a class="navbar-brand" href="{{route('index')}}">
						<img src="{{ asset('images/procurovagasnegativo.png') }}" alt="Procurar vagas" width="45" height="45">
						<!-- ProcuroVagas -->
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
						<form class="d-flex" method="GET" action="{{route('searchvaga.form')}}">
							<input class="form-control me-2" type="search" placeholder="Procurar Vagas" aria-label="Search" name="searchterm">
							<button class="btn btn-outline-light" type="submit"><i class="bi-search"></i></button>
						</form>
					</div>
				</div>
			</nav>

			<!-- alerts -->
			<!-- Modal -->
			<div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertTitle" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAlertTitle"></h5>
					<button type="button" class="btn-close closeAlert" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="modalAlertBody">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn black-90 text-white closeAlert" data-bs-dismiss="modal">Ok</button>
				</div>
				</div>
			</div>
			</div>

			<div class="container" id="main">
				<!-- conteudo -->
				@yield('content')
			</div>

			<footer class="text-center text-lg-start navbar-dark black-90 text-muted">
				<!-- Section: Links  -->
				<section class="pt-1">
					<div class="container text-center text-md-start mt-5">
						<!-- Grid row -->
						<div class="row mt-3">
							<!-- Grid column -->
							<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 justify">
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
								<p>
									<a class="text-reset" href="sitemap.xml" data-id="6">SiteMap</a>
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
	@yield('scripts')