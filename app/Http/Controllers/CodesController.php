<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cnpj;

class CodesController extends Controller
{
    /**
	 * usar o controller para chegar ao model
	 * e pegar o cnpj
	 * @param [string] $request
	 * @return json
	 */
	public function cnpj($request = null)
	{
		$cnpj = new Cnpj();
		return $cnpj->getcnpj($request);
	}
}
