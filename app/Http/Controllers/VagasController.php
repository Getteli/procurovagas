<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vagas;

class VagasController extends Controller
{
    
    public function createManually(Request $request)
    {
        try {
            $vaga = new Vagas();
            $result = $vaga->createManually($request);

			if ($result) {
				\Session::flash('message',[
					'title'=> 'Vaga criada !',
					'message'=> 'Sua vaga foi criada com sucesso e em instantes começará a rodar para todos os candidatos.',
					'messagetwo' => 'Fique atento logo candidatos entraram em contato.',
					'type' => 'success'
					]);
			}
			else{
				throw new \Exception("erro ao criar a vaga. Tente novamente");
			}
			return redirect()->back()->withInput();
        } catch (\Throwable $e) {
			// create session message
			\Session::flash('message',[
				'title'=> 'Ops :(',
				'message'=> $e->getMessage(),
				'type' => 'danger'
			]);
			return redirect()->back()->withInput();
        }
    }
}
