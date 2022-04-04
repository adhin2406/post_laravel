<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = "m_customer";
    protected $guarded = ['id_customer'];
    protected $primaryKey   = 'id_customer';
    public $timestamps   = true;

    public function kode_customer($jumlah)
    {
        $code = 'KODECUSTOMER2022' . time();
        $string = '';
        for ($i = 0; $i < $jumlah; $i++) {
            $pos = rand(0, strlen($code) - 1);
            $string .= $code[$pos];
        }
        return 'ID' . $string;
    }
}
