<?php namespace App\Models;

    use CodeIgniter\Model;

    class TransaksiModel extends Model
    {
        protected $table = 'transaksi'; 
        protected $primaryKey = 'id';
        protected $allowedFields = [
            'username','total_harga','alamat', 'ongkir', 'status','created_by', 'created_date'
        ];  
    }