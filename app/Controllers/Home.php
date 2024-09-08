<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class Home extends BaseController
{
    function __construct()
    {
        helper('number');
        helper('form');
    }
    
    public function index()
    {
        $produkModel = new ProdukModel(); 
        $produk = $produkModel->findAll();
        $data['produks'] = $produk;
        
        return view('home_view', $data);
    } 
}