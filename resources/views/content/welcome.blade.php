<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<!-- slide -->
	<div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="{{ asset('images/fase1.png') }}" class="d-block w-75 mx-auto" alt="A sua vaga está aqui !">
			</div>
			<div class="carousel-item">
				<img src="{{ asset('images/fase2.png') }}" class="d-block w-75 mx-auto" alt="As principais vagas em apenas um só lugar">
			</div>
			<div class="carousel-item">
				<img src="{{ asset('images/fase3.png') }}" class="d-block w-75 mx-auto" alt="O seu futuro está aqui !!">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>

	<!-- form -->
	<div class="container cardstyle">
		<form class="row g-3" action="">
			<div class="col-md-6">
				<i class="bi bi-info-lg information" title="digite sobre a vaga que deseja"></i>
				<label for="inputText" class="form-label">O que deseja procurar ?</label>
				<input type="text" id="inputText" class="form-control" placeholder="a vaga que eu desejo...">
			</div>
			<div class="col-md-2">
				<i class="bi bi-info-lg information" title="caso não escolha o estado, será exibido de todo o Brasil"></i>
				<label for="inputState" class="form-label">Estado</label>
				<select id="inputState" class="form-select">
					<option value="" selected>Escolha...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-md-4">
				<i class="bi bi-info-lg information" title="escolha o estado primeiro"></i>
				<label for="inputCity" class="form-label">Cidade</label>
				<select id="inputCity" class="form-select">
					<option value="" selected>Escolha o estado</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="inputType" class="form-label">Tipo de vaga</label>
				<select id="inputType" class="form-select">
					<option value="" selected>Escolha...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="inputSal" class="form-label">Faixa salarial</label>
				<select id="inputSal" class="form-select">
					<option value="0" selected>Escolha...</option>
					<option value="1">...</option>
				</select>
			</div>
			<div class="col-3">
				<label for="inputState" class="form-label">Pesquisar</label><br>
				<button class="btn btn-outline-dark" type="submit"><i class="bi-search"></i></button>
			</div>
		</form>
	</div>

	<!-- list -->
	<div class="container cardstyle mt-5 mb-5">
		<div class="row row-cols-1 row-cols-md-4 g-4 list">

			<div class="col-md-4 col-sm-12">
				<div class="card text-dark bg-light mb-3">
					<div class="card-header text-center"">Header</div>
					<div class="card-body">
						<h5 class="card-title text-center"">Light card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
					<a href="/detail">
						<div class="card-footer text-center">abrir vaga</div>
					</a>
				</div>
			</div>

		</div>
		
		<!-- paginação -->
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item disabled"><a class="page-link text-black-90" href="#">Voltar</a></li>
				<li class="page-item"><a class="page-link text-black-90 actived-page" href="#">1</a></li>
				<li class="page-item disabled"> <a class="page-link text-black-90" href="#">Próxima</a></li>
			</ul>
		</nav>
	</div>
@endsection

<!-- scripts -->
@section('scripts')
	<script src="{{ asset('js/cidade-estado.js') }}"></script>
	<script language="JavaScript" type="text/javascript" charset="utf-8">
		new dgCidadesEstados({
			cidade: document.getElementById('inputCity'),
			estado: document.getElementById('inputState')
		})
	</script>
@endsection

<!-- page active -->
@section('index') active @endsection