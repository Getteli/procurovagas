<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendFormAbout;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * envia o formulario da pagina sobre, formulario de contato
     *
     * @param Request $request
     * @return void
     */
    public function sendForm(Request $request)
    {
        try
        {
            Mail::to(\Config::get('mail.from.address'))
            ->send(new SendFormAbout('Mensagem enviada pela página de contato',
            $request->name, $request->description, $request->email, 'now'));
    
            \Session::flash('message',[
                'title'=> 'Email enviado com sucesso',
                'message'=> 'Analisaremos seu email e entraremos em contato o mais rapido possivel.',
                'type' => 'success'
            ]);

			return redirect()->back();
        }
        catch (\Throwable $e)
        {
			// create session message
			\Session::flash('message',[
				'title'=> 'Ops :(',
				'message'=> "Seu email nao pode ser enviado, tente novamente mais tarde.",
				'type' => 'danger'
			]);
    
			return redirect()->back()->withInput();
        }
    }
}
