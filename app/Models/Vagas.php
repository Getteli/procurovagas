<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Enum\TipoVaga;
use App\Enum\TipoEmail;
use App\Enum\Origem;
use App\Enum\Subscribe;
use App\Enum\FormaTrabalho;
use Illuminate\Http\Request;
use App\Models\Emails;
use App\Aux\Codes;

class Vagas extends Model
{
    use HasFactory, Notifiable;

	/**
	 * definindo a tabela desse model
	 * definindo a chave primaria q nao se chama apenas id
	 * @var string
	 */
	protected $table = "vagas";
	protected $primaryKey = 'vagas_id';
	/**
	 * indicação de que se esta tabela tem auto incremento
	 *
	 * @var boolean
	 */
	public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origem',
        'cnpj',
        'razao_social',
		'nome_recrutador',
		'desc_empresa',
		'tipo_vaga',
		'cargo',
		'n_vagas',
		'forma_trabalho',
		'cidade',
		'estado',
		'desc_vaga',
		'cep',
		'endereco',
		'numero',
		'bairro',
		'qualificacao',
		'remuneracao',
		'beneficios',
		'jornada',
		'created_at',
		'updated_at',
		'tempo_vaga',
		'slug',
		'link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'vagas_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'tempo_vaga' => 'datetime',
    ];

	/**
	 * atributos que serao resguardados
	 *
	 * @var array
	 */
	protected $guarded = [
		'vagas_id',
		'created_at',
		'update_at',
		'tempo_vaga'
	];

	/**
	 * NAVIGATION
	 * a navegação entre as relações
	 * @return void
	 */
	public function Emails()
	{
		return $this->hasMany(Emails::class,'vagas_id');
	}

	#region METHODS

		public function createManually(Request $request)
		{
			$vaga = $email = null;
			try {
				$email = new Emails();

				$vaga = $this::create([
					'cnpj' => $request->cnpj,
					'origem' => Origem::Cadastro,
					'razao_social' => $request->razaoSocial,
					'nome_recrutador' => $request->nomeRecrutador,
					'desc_empresa' => $request->aboutEmpresa,
					'tipo_vaga' => $request->tipoVaga,
					'cargo' => $request->cargo,
					'n_vagas' => $request->nVaga,
					'forma_trabalho' => $request->formaTrabalho,
					'desc_vaga' => $request->descVaga,
					'qualificacao' => $request->qualificacao,
					'remuneracao' => $request->remuneracao,
					'jornada' => "{$request->jornadaInicio} até {$request->jornadaFim}",
					'cep' => $request->cep,
					'endereco' => $request->logradouro,
					'beneficios' => $request->beneficios,
					'numero' => $request->complemento,
					'bairro' => $request->bairro,
					'estado' => $request->state,
					'cidade' => $request->city,
					'slug' => substr(Codes::removeAllSpaces("{$request->razaoSocial}_{$request->cargo}"), 0, 100),
					'tempo_vaga' => $request->tempoVaga
				]);
				
				if (!$email->where('email',$request->email)->exists()) {
					$email->create([
						'vagas_id' => $vaga->vagas_id,
						'email' => $request->email,
						'tipo_email' => TipoEmail::Empresa,
						'config_subscribe' => Subscribe::ReceberTudo,
					]);
				}

				return true;
			} catch (\Throwable $e) {
				if ($vaga) {
					$vaga->delete();
				}
				if ($email) {
					$email->delete();
				}

				return false;
				// return $e->getMessage();
			}
		}

		public function createVagaWS(array $vagas)
		{
			$vaga = null;
			try
			{
				foreach ($vagas as $key => $vaga)
				{
					$cargo = substr($vaga["titulo"], 0, 50);
					// $cargo = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$cargo);
					$razao_social = substr($vaga["empresa"], 0, 100);
					// $razao_social = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $razao_social);
					$desc_vaga = substr($vaga["desc_vaga"], 0, 4294967295);
					// $desc_vaga = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$desc_vaga);
					$estado = substr($vaga["estado"], 0, 2);
					// $estado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$estado);
					$cidade = substr($vaga["cidade"], 0, 100);
					// $cidade = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$cidade);

					$vaga = $this::create([
						'origem' => Origem::WebScrapper,
						'cargo' => $cargo,
						'razao_social' => $razao_social,
						'n_vagas' => $vaga["n_vagas"],
						'remuneracao' => $vaga["remuneracao"],
						'desc_vaga' => $desc_vaga,
						'estado' => $estado,
						'cidade' => $cidade,
						'slug' => $vaga["slug"] ? substr($vaga["slug"], 0, 100) : null,
						'link' => substr($vaga["link"], 0, 255),
					]);
				}
				return true;
			}
			catch (\Throwable $e)
			{
				echo $e->getMessage();
			}
		}

		public static function listVagas()
		{
			try {
				$vagas = self::paginate(27);
				return $vagas;
			} catch (\Throwable $th) {
				//throw $th;
				return null;
			}
		}

		public static function getVagaWithParams(Request $request)
		{
			try {
				$vagas = new Vagas();
				//paginate(1);

				if (!empty($request->searchterm)) {
					$vagas = $vagas->Where(function ($vagas) use($request) {
						$vagas->where('cargo','LIKE','%'.$request->searchterm.'%')
						->orWhere('razao_social','LIKE','%'.$request->searchterm.'%')
						->orWhere('desc_vaga','LIKE','%'.$request->searchterm.'%');
					});
				}

				if (!empty($request->state)) {
					$vagas = $vagas->where('estado',$request->state);
				}

				if (!empty($request->city)) {
					$vagas = $vagas->where('cidade',$request->city);
				}

				if (!empty($request->type_vaga)) {
					$vagas = $vagas->where('tipo_vaga',$request->type_vaga);
				}

				if ($request->remuneracao != 0) {
					switch ($request->remuneracao) {
						case '600':
							$vagas = $vagas->where('remuneracao','<=',$request->remuneracao);
							break;
						case '1000':
							$vagas = $vagas->where('remuneracao','<=',$request->remuneracao);
							break;
						case '1500':
							$vagas = $vagas->where('remuneracao','<=',$request->remuneracao);
							break;
						case '1501':
							$vagas = $vagas->where('remuneracao','>=','1500');
							break;
					}
				};
				return $vagas->paginate(27);
			} catch (\Throwable $th) {
				return false;
			}
		}

		public function isWS()
		{
			if (Origem::isWebScrapper($this->origem))
			{
				return true;
			}

			return false;
		}

		public function getEmailOwner()
		{
			$email = Emails::where('vagas_id', $this->vagas_id)->where('tipo_email', TipoEmail::Empresa)->first();
			return $email->email ?? '';
		}
	#endregion
}
