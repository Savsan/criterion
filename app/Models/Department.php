<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model{

    protected $table = 'departments';
    protected $primaryKey = 'iddepartments';
    public $timestamps = false;

    protected $fillable = [
        'department_name',
        'company_idcompany',
        'date_create',
        'date_close',
        'department_description',
    ];

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_idcompany', 'idcompany');
    }
    
    /*public function users(){
        return $this->hasMany('App\Models\Position', 'departments_iddepartments', 'iddepartments');
    }*/

    public static function deleteDepartment($args){
        $id = $args['id'];
        self::where('iddepartments', '=', $id)->delete();
    }

}