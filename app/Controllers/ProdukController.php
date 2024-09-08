<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;

		class ProdukController extends BaseController
		{
			protected $produk;

			function __construct()
			{
				helper('form');
				$this->validation = \Config\Services::validation();
				$this->produk = new ProdukModel();
			}

			public function index()
			{
				$data['produks'] = $this->produk->findAll();
				return view('pages/produk_view', $data);
			}

			public function create()
			{
				$data = $this->request->getPost();
				$validate = $this->validation->run($data, 'barang');
				$errors = $this->validation->getErrors();

				if(!$errors){
					$dataForm = [ 
						'nama' => $this->request->getPost('nama'),
						'harga' => $this->request->getPost('harga'),
						'jumlah' => $this->request->getPost('jumlah'),
						'keterangan' => $this->request->getPost('keterangan')
					];
			
					$dataFoto = $this->request->getFile('foto');
			
					if ($dataFoto->isValid()){
						$fileName = $dataFoto->getRandomName();
						$dataFoto->move('public/img/', $fileName);
						$dataForm['foto'] = $fileName;
					}  
			
					$this->produk->insert($dataForm); 
			
					return redirect('produk')->with('success','Data Berhasil Ditambah');
				}else{
					return redirect('produk')->with('failed',implode("<br>",$errors));
				}    
			}

			public function edit($id)
			{
				$data = $this->request->getPost();
				$validate = $this->validation->run($data, 'barang');
				$errors = $this->validation->getErrors();

				if(!$errors){
					$dataForm = [
						'nama' => $this->request->getPost('nama'),
						'harga' => $this->request->getPost('harga'),
						'jumlah' => $this->request->getPost('jumlah'),
						'keterangan' => $this->request->getPost('keterangan')
					];

					if($this->request->getPost('check')){
						$dataFoto = $this->request->getFile('foto');
						if ($dataFoto->isValid()){
							$fileName = $dataFoto->getRandomName();
							$dataFoto->move('public/img/', $fileName);
							$dataForm['foto'] = $fileName;
						}             
					}

					$this->produk->update($id, $dataForm);

					return redirect('produk')->with('success','Data Berhasil Diubah');
				}else{
					return redirect('produk')->with('failed',implode("",$errors));
				}
				
			}

			public function delete($id)
			{
				$dataProduk = $this->produk->find($id);
				unlink("public/img/".$dataProduk['foto']);	

				$this->produk->delete($id);

				return redirect('produk')->with('success','Data Berhasil Dihapus');
			}
		}