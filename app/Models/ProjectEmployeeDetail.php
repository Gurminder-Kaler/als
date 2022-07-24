<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEmployeeDetail extends Model
{
    use HasFactory;

    public function project() {

        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
        
    }
    
    public function employee() {

        return $this->belongsTo('App\Models\EmployeeDetail', 'employee_detail_id', 'id');
        
    }
}
