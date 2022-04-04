<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_sales extends Model
{
    use HasFactory;
    protected $table = "t_sales";
    protected $guarded = ['id_t_sales'];
    protected $primaryKey   = 'id_t_sales';
    public $timestamps   = true;

    public function no_transaksi($angka)
    {
        $code = '12345678901234567890' . time();
        $string = '';
        for ($i = 0; $i < $angka; $i++) {
            $pos = rand(0, strlen($code) - 1);
            $string .= $code[$pos];
        }
        return '' . $string;
    }
}
