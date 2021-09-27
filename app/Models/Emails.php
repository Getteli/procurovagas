<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Emails extends Model
{
    use HasFactory, Notifiable;

	/**
	 * definindo a tabela desse model
	 * definindo a chave primaria q nao se chama apenas id
	 * @var string
	 */
	protected $table = "emails";
	protected $primaryKey = 'emails_id';
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
        'email',
		'vagas_id',
        'tipo_email',
        'config_subscribe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'emails_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
		'updated_at' => 'datetime',
    ];

	/**
	 * atributos que serao resguardados
	 *
	 * @var array
	 */
	protected $guarded = [
		'emails_id',
		'created_at',
		'update_at',
	];

	/**
	 * NAVIGATION
	 * a navegação entre as relações
	 * @return void
	 */
	public function Vagas()
	{
		return $this->belongsTo(Vagas::class,'vagas_id');
	}
}
