async function preventAdBlock()
{
	let adBlockEnabled = false;
	const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';

	try
	{
		await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true);
	}
	catch(e)
	{
		adBlockEnabled = true;
	}
	finally
	{
		// se tiver com o adblock ativado impede de exibir o conteudo do site.
		if(adBlockEnabled)
		{
			document.getElementById("main").style.display = 'none';

			document.getElementById("staticBackdrop").style.display = 'block';
			document.getElementById("staticBackdrop").classList.add("show");
			document.getElementById("staticBackdrop").setAttribute('aria-modal','true');
			document.getElementById("staticBackdrop").setAttribute('role','dialog');
		}
	}
}