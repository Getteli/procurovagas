<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cnpj extends Model
{
	use HasFactory;

	/**
	 * Metodo que fará uma comunicação via cURL
	 * no site da receita, mais precisamente na sua API
	 * para fazer a requisição dos dados com base em seu CNPJ
	 * @param String|null $cnpj
	 * @return json
	 */
	public function getcnpj($cnpj = null)
	{
		try {
			if (!empty($cnpj)) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$cnpj);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$data = curl_exec($ch);
				curl_close($ch);

				echo json_encode($data);
			}
		} catch (\Throwable $th) {
			//throw $th;
		}
	}
}
