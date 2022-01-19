<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<li class="breadcrumb-item active-bc" aria-current="page">Nossa política e privacidade</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1 class="display-6">Política e privacidade</h1>
		<div class="container p-5 justify">
			<h2 class="subtitle">
				subtitle
			</h2>
			<p>
				paragrafo
			</p>
			<a href="https://www.iubenda.com/privacy-policy/36805394" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Política de Privacidade ">Política de Privacidade</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
		</div>
	</div>
@endsection

<!-- page active -->
@section('politicaeprivacidade') active @endsection