<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_img', 'project_link', 'description', 'published', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getDescription()
    {
        return substr($this->description, 0, 30) . '...';
    }

    public function getProjectLink()
    {
        $link = $this->project_link;
        if (strlen($link) > 20) {
            $link =  substr($this->project_link, 0, 20) . '...';
        }
        return $link;
    }
}
