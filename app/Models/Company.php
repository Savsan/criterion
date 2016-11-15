<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{

    protected $table = 'company';
    protected $primaryKey = 'idcompany';
    public $timestamps = false;

    protected $fillable = [
        'company_name',
    ];


    public function users()
    {
       return $this->hasMany('App\Models\User', 'company_idcompany', 'idcompany');
    }

}