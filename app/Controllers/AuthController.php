<?php
		namespace App\Controllers;
		use App\Models\userModel;
		class AuthController extends BaseController
		{
    protected $user;
    function __construct()
		{		        helper('form');
        $this->user = new userModel();
		}
		public function login()
		{
		if ($this->request->getPost()) {
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');
			$dataUser = $this->user->where(['username' => $username])->first();
			if ($dataUser) {
				if($dataUser['status']== 1){
					if (md5($password) == $dataUser['password']) {
						session()->set([
							'username' => $dataUser['username'],
							'role' => $dataUser['role'],
							'isLoggedIn' => TRUE
							]);
								return redirect()->to(base_url('/'));
							}else{
								session()->setFlashdata('failed', 'Username & Password Salah');
								return redirect()->back();
							}
						}else {
							session()->setFlashdata('failed', 'Akun belum di verifikasi oleh admin ');
							return redirect()->back();
						}
					} else {
						session()->setFlashdata('failed', 'Username Tidak Ditemukan');
						return redirect()->back();
					}
				} else {
					return view('login_view');
				}
			}
			public function logout()
			{session()->destroy();
				return redirect()->to('login');
			}
			public function register()
			{
				if ($this->request->getPost()) {
					$username = $this->request->getVar('username');
					$password = md5($this->request->getVar('password'));
					$email = $this->request->getVar('email');
					$data = [
						'username' => $username,
						'password' => $password,
						'email' => $email
					];
					$this->user->insert($data);
					session()->setFlashdata('success', 'Registration Successful!');
					return redirect()->to('login');
				} else {
					return view('register_view');
				}
			}
		}