<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'salary', 'user_id', 'created_at', 'deleted_at' , 'updated_at'];

    // public function employeeDetailJob() {

    //     $d =  $this->belongsTo('App\Models\EmployeeDetailJob', 'id', 'employee_detail_id');
    //     dd($d);
    //     return $d;
 
    //  }

    public function department() {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function jobTitle() {
        return $this->belongsTo('App\Models\JobTitle', 'job_title_id', 'id');
    }

    public function project() {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
 
}
