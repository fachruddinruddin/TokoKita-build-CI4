<?php

		namespace App\Controllers;
		use App\Models\UserModel;

		class AdminController extends BaseController
		{
			protected $user;

			function __construct()
			{
				helper('form');
				$this->validation = \Config\Services::validation();
				$this->user = new UserModel();
			}

			public function index()
			{
				$data['users'] = $this->user->findAll();
				return view('pages/admin_view', $data);
			}

			public function create()
			{
				$data = $this->request->getPost();
				
				if($data){
					$dataForm = [ 
						'username' => $this->request->getPost('username'),
						'password' => md5($this->request->getPost('password')),
						'role'=> $this->request->getPost('role'),
						'email' => $this->request->getPost('email')
					];

					$this->user->insert($dataForm); 
			
					return redirect('admin')->with('success','Data Berhasil Ditambah');
				}else{
					return redirect('admin')->with('failed',implode("<br>",$errors));
				}    
			}

			public function edit($id)
			{
				$data = $this->request->getPost();
				if($data){
					if($data){
						if($data['rolekey']==false){
							$dataForm =[
								'status' => $this -> request -> getPost('status')
							];
						}else{
							$dataForm =[
								'role' => $this -> request -> getPost('role'),
								'email' => $this -> request -> getPost('email')
							];
						}
					}
					$this->user->update($id, $dataForm);
					return redirect('admin')->with('success','Data Berhasil Diubah');
				}else{
					return redirect('admin')->with('failed','Data gagal di perbarui');
				}
				
			}
			public function delete($id)
			{	
				$this->user->delete($id);
				return redirect('admin')->with('success','Data Berhasil Dihapus');
			}
		}