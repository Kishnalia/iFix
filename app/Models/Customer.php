<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $table = "customers";
    public $timestamps = false;
    public $primaryKey = "customer_id";
    public $guarded = ["customer_id"];
    
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
