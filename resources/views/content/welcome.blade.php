<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<h1 class="d-none">Procurar vagas</h1>
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

	<h2 class="d-none">buscar sua vaga de emprego</h2>
	<!-- form -->
	<div class="container cardstyle">
		<form class="row g-3" method="GET" action="{{route('searchvaga.form')}}">
			<div class="col-md-6">
				<i class="bi bi-info-lg information" title="digite sobre a vaga que deseja"></i>
				<label for="inputText" class="form-label">O que deseja procurar ?</label>
				<input type="text" id="inputText" class="form-control" name="searchterm" placeholder="a vaga que eu desejo..." value="{{request()->get('searchterm')}}">
			</div>
			<div class="col-md-2">
				<i class="bi bi-info-lg information" title="caso não escolha o estado, será exibido de todo o Brasil"></i>
				<label for="inputState" class="form-label">Estado</label>
				<select id="inputState" class="form-select" name="state">
					<option value="" selected>Escolha...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-md-4">
				<i class="bi bi-info-lg information" title="escolha o estado primeiro"></i>
				<label for="inputCity" class="form-label">Cidade</label>
				<select id="inputCity" class="form-select" name="city">
					<option value="" selected>Escolha o estado</option>
				</select>
			</div>
			<div class="col-md-3">
				<label for="inputType" class="form-label">Tipo de vaga</label>
				<select id="inputType" class="form-select" name="type_vaga">
					<option value="" selected>Escolha...</option>
					@foreach($tipoVaga::list() as $item => $key)
						<option value="{{$key}}" {{ request()->get('type_vaga') !== null ? (request()->get('type_vaga') == $key ? 'selected' : '') : '' }}>{{$item}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-3">
				<label for="inputSal" class="form-label">Faixa salarial</label>
				<select id="inputSal" class="form-select" name="remuneracao">
					<option value="0" selected>Escolha...</option>
					<option value="600" {{ request()->get('remuneracao') !== null ? (request()->get('remuneracao') == '600' ? 'selected' : '') : '' }}>até R$ 600</option>
					<option value="1000" {{ request()->get('remuneracao') !== null ? (request()->get('remuneracao') == '1000' ? 'selected' : '') : '' }}>até R$ 1000</option>
					<option value="1500" {{ request()->get('remuneracao') !== null ? (request()->get('remuneracao') == '1500' ? 'selected' : '') : '' }}>até R$ 1500</option>
					<option value="1501" {{ request()->get('remuneracao') !== null ? (request()->get('remuneracao') == '1501' ? 'selected' : '') : '' }}>acima de R$ 1500</option>
				</select>
			</div>
			<div class="col-3">
				<label for="inputState" class="form-label">Pesquisar</label><br>
				<button class="btn btn-outline-dark" type="submit"><i class="bi-search"></i></button>
			</div>
		</form>
	</div>

	<div class="container cardstyle mt-5 mb-5">
		<!-- list -->
		<div class="row row-cols-1 row-cols-md-4 g-4 list">
			@if(count($vagas) != 0)
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8352280684472674"
					crossorigin="anonymous"></script>
				<ins class="adsbygoogle"
					style="display:block"
					data-ad-format="fluid"
					data-ad-layout-key="-gw-3+1f-3d+2z"
					data-ad-client="ca-pub-8352280684472674"
					data-ad-slot="9473681713"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				@foreach($vagas as $key => $vaga)
					<div class="col-md-4 col-sm-12 size-card">
						<div class="card text-dark bg-light mb-3 size-card">
							<div class="card-header text-center">{{$vaga->cargo}}</div>
							<div class="card-body">
								<h6 class="card-title text-center">{{$vaga->tipo_vaga}}</h6>
								<p class="card-text">{{$vaga->razao_social}}</p>
								<span class="size-span-card">
									<p class="card-text limit-p">{!! $vaga->desc_vaga !!}...</p>
								</span>
								<span class="card-text pos-footer-card w-100">
									<hr class="pos-hr"/>
									@if($vaga->remuneracao != -1)
										<p>R$ {{($vaga->remuneracao == 0.00 ? 'à combinar' : $vaga->remuneracao)}} | <b>{{$vaga->n_vagas}}</b> vagas</p>
									@else
										<p>Acesse a vaga e <b>saiba mais</b></p>
									@endif
								</span>
							</div>
							@if($vaga->slug != null)
								<a href="{{route('detail',$vaga->slug)}}">
									<div class="card-footer text-center">abrir vaga</div>
								</a>
							@else
								<a href="{{ $vaga->link }}" target="_blank">
									<div class="card-footer text-center">abrir vaga</div>
								</a>
							@endif
						</div>
					</div>
				@endforeach
			@else
				<h3 class="w-100 text-center">Infelizmente não encontramos nenhuma vaga com esses termos.</h3>
			@endif
		</div>

		<!-- paginação -->
        <div class="d-flex justify-content-center">
            {!! $vagas->appends([
				'searchterm' => request()->get('searchterm')??'',
				'state' => request()->get('state')??'',
				'city' => request()->get('city')??'',
				'type_vaga' => request()->get('type_vaga')??'',
				'remuneracao' => request()->get('remuneracao')??'',
				])->links() !!}
        </div>
	</div>
@endsection

<!-- scripts -->
@section('scripts')
	<script src="{{ asset('js/cidade-estado.js') }}"></script>
	<script language="JavaScript" type="text/javascript" charset="utf-8">
		new dgCidadesEstados({
			cidade: document.getElementById('inputCity'),
			estado: document.getElementById('inputState'),
			estadoVal: "{{request()->get('state')??null}}",
        	cidadeVal: "{{request()->get('city')??null}}"
		})
	</script>
@endsection

<!-- page active -->
@section('index') active @endsection