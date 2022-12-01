<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $primaryKey = 'service_id';
    public $table = "services";

    public $guarded = ['service_id'];
    protected $fillable = [
        'description',
        'price',
        'img_path'
    ];

}

