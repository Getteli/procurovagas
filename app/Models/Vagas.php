<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
		'local',
		'desc_empresa',
		'tipo_vaga',
		'cargo',
		'n_vagas',
		'forma_trabalho',
		'cidade',
		'estado',
		'desc_vaga',
		'qualificacao',
		'caracteristicas',
		'remuneracao',
		'beneficios',
		'jornada',
		'created_at',
		'updated_at',
		'tempo_vaga'
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
		return $this->hasMany('App\Models\Emails','emails_id');
	}
}
