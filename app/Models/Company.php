<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{

    protected $table = 'company';
    protected $primaryKey = 'idcompany';
    public $timestamps = FALSE;

    protected $fillable = [
        'company_name',
    ];
    
}