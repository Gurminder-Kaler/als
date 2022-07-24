<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDepartment extends Model
{
    use HasFactory;

    public function project() {

        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
        
    }
    
    public function department() {

        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
        
    }

}
