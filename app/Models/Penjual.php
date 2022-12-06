<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjual extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_penjual', 'nama_penjual','no_telp','alamat_penjual'
    ];
    protected $primaryKey = 'id_penjual';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}