<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = "m_barang";
    protected $guarded = ['id_barang'];
    protected $primaryKey   = 'id_barang';
    public $timestamps   = true;

    public function kode_barang($jumlah)
    {
        $code = 'ABCDE2022' . time();
        $string = '';
        for ($i = 0; $i < $jumlah; $i++) {
            $pos = rand(0, strlen($code) - 1);
            $string .= $code[$pos];
        }
        return 'ID' . $string;
    }
}
