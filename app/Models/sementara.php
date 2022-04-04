<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sementara extends Model
{
    use HasFactory;
    protected $table = "sementara";
    protected $guarded = ['id_sementara'];
    protected $primaryKey   = 'id_sementara';
    public $timestamps   = true;

    public function kode_sementara($jumlah)
    {
        $code = 'HANYASEMENTARAINI' . time();
        $string = '';
        for ($i = 0; $i < $jumlah; $i++) {
            $pos = rand(0, strlen($code) - 1);
            $string .= $code[$pos];
        }
        return 'ID' . $string;
    }
}
