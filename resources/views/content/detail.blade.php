<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<li class="breadcrumb-item active-bc" aria-current="page">{{$vaga->slug}}</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1>{{$vaga->cargo}}</h1>

		<div class="accordion" id="accordionDetails">
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Sobre a vaga
				</button>
				</h2>
				<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionDetails">
				<div class="accordion-body">
					<strong>Descrição da vaga </strong><br>
					{{$vaga->desc_vaga}}
					<hr>
					<strong>Cargo </strong><br>
					{{$vaga->cargo}}
					<hr>
					<strong>Tipo de vaga </strong><br>
					{{$vaga->tipo_vaga}}
					<hr>
					<strong>Forma de trabalho </strong><br>
					{{$vaga->forma_trabalho}}
					<hr>
					<strong>n° de vagas </strong><br>
					{{$vaga->n_vagas}}
					<hr>
					<strong>Jornada </strong><br>
					{{$vaga->jornada}}
					<hr>
					<strong>Local </strong><br>
					{{$vaga->endereco}}, {{$vaga->numero}}, {{$vaga->bairro}}, {{$vaga->cidade}} - {{$vaga->estado}}
				</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					Beneficios
				</button>
				</h2>
				<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionDetails">
				<div class="accordion-body">
					<strong>Remuneração</strong><br>
					R$ {{$vaga->remuneracao}}
					<hr>
					<strong>Beneficios</strong><br>
					R$ {{$vaga->beneficios}}
				</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingThree">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					Qualificação desejada
				</button>
				</h2>
				<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionDetails">
				<div class="accordion-body">
					<strong>Qualificação</strong><br>
					{{$vaga->qualificacao}}
				</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingFour">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
					Sobre a empresa
				</button>
				</h2>
				<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionDetails">
				<div class="accordion-body">
					<strong>Nome</strong><br>
					{{$vaga->razao_social}}
					<hr>
					<strong>Descrição</strong><br>
					{{$vaga->desc_empresa}}
				</div>
				</div>
			</div>
		</div>
		&nbsp;
		<hr>
		@if($vaga->isWS())
			<div class="d-grid gap-2">
				<a href="{{ $vaga->link }}" target="_blank" class="btn btn-primary" type="button">CANDIDATAR</a>
			</div>
		@else
			<!-- notifications -->
			@if(Session::has('message'))
				<div class="alert alert-{{ Session::get('message')['type'] }}" role="alert">
					<h4 class="alert-heading">{{ Session::get('message')['title'] }}</h4>
					<p>{{ Session::get('message')['message'] }}</p>
				</div>
			@endif
			<div class="d-grid gap-2">
				<h3 class="subtitle text-center">
					Candidatar-se
				</h3>
				<form class="row g-3 row-cols-1 d-flex justify-content-center" method="POST" action="{{ route('send.form.vaga') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="emailowner" value="{{ $vaga->getEmailOwner() }}">
						<div class="col-md-4 col-sm-12">
							<label for="inputEmail" class="form-label">Seu e-mail</label>
							<input type="email" id="inputEmail" name="email" class="form-control" placeholder="seuemail@..." required>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="inputName" class="form-label">Nome</label>
							<input type="text" id="inputname" name="name" class="form-control" placeholder="seu nome" required>
						</div>
						<div class="col-md-8 col-sm-12">
							<label for="inputTextArea">Descreva por que gostaria dessa vaga</label>
							<textarea id="inputTextArea" name="description" class="form-control" required></textarea>
						</div>
						<div class="col-md-8 col-sm-12">
							<label for="formFile" class="form-label">Subir seu Currículo</label>
							<input class="form-control" type="file" accept=".pdf" id="cv" name="cv" required>
						</div>
						<div class="col-md-8 col-sm-12 d-flex justify-content-end">
							<button class="btn btn-outline-dark" type="submit"><i class="bi-envelope"></i></button>
						</div>
					</form>
			</div>
		@endif
	</div>
@endsection