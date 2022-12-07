<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Pembeli extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_pembeli', 'nama_pembeli','no_telp','alamat_pembeli', 'id_vinyl'
    ];
    protected $primaryKey = 'id_pembeli';
    protected $keyType = 'bigInteger';
    public $incrementing = false;

}