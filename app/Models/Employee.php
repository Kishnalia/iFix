<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = "employees";
    public $timestamps = false;
    public $primaryKey = "employee_id";
    public $guarded = ["employee_id"];
    
    protected $fillable = [
        "title",
        "lname",
        "fname",
        "addressline",
        "town",
        "zipcode",
        "phone",
        "img_path",
        "user_id"
    ];
}
