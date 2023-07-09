<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NastaveniWebu extends Model
{
    protected $table = 'nastaveni_webu';
    protected $fillable = ['nazev_webu', 'popis_webu', 'kontaktni_email', 'telefon'];
}
