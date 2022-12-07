<?php
  
namespace App\Models;
  

  
class Vinyl extends Model
{
    
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_vinyl', 'title','artist','genre', 'status', 'stok', 'id_penjual'
    ];
    protected $primaryKey = 'id_vinyl';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}