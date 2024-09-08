<?php

    namespace App\Controllers;

    use App\Controllers\BaseController;

    class TransaksiController extends BaseController
    {
        protected $cart;
        private $url = "https://api.rajaongkir.com/starter/";
		private $apiKey = "77e49b9969eae0fb5407864e4cf4b5fc";

        function __construct()
        {
            helper('number');
            helper('form');
            $this->cart = \Config\Services::cart();
        }

        public function cart_show()
        {
            $data['items'] = $this->cart->contents();
            $data['total'] = $this->cart->total();
            return view('pages/keranjang_view', $data);
        }

        public function cart_add()
        {
            $this->cart->insert(array(
                'id'    => $this->request->getPost('id'),
                'qty'   => 1,
                'price'    => $this->request->getPost('harga'),
                'name'    => $this->request->getPost('nama'),
                'options' => array('foto' => $this->request->getPost('foto'))
            ));
            session()->setflashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url() . 'keranjang">Lihat</a>)');
            return redirect()->to(base_url('/'));
        }

        public function cart_clear()
        {
            $this->cart->destroy();
            session()->setflashdata('success', 'Keranjang Berhasil Dikosongkan');
            return redirect()->to(base_url('keranjang'));
        }

        public function cart_edit()
        {
            $i = 1;
            foreach ($this->cart->contents() as $value) {
                $this->cart->update(array(
                    'rowid' => $value['rowid'],
                    'qty'   => $this->request->getPost('qty' . $i++)
                ));
            }

            session()->setflashdata('success', 'Keranjang Berhasil Diedit');
            return redirect()->to(base_url('keranjang'));
        }

        public function cart_delete($rowid)
        {
            $this->cart->remove($rowid);
            session()->setflashdata('success', 'Keranjang Berhasil Dihapus');
            return redirect()->to(base_url('keranjang'));
        }


        public function checkout(){
            $data['items'] = $this->cart->contents();
            $data['total'] = $this->cart->total();
            $provinsi = $this->rajaongkir('province');
            $data['provinsi'] = json_decode($provinsi)->rajaongkir->results;

            return view('pages/checkout_view', $data);
        }

        public function getCity()
        {
            if ($this->request->isAJAX()){
                $id_province = $this->request->getGet('id_province');
                $data = $this->rajaongkir('city', $id_province);
                return $this->response->setJSON($data);
            }
        }

        public function getCost()
        {
            if ($this->request->isAJAX()){
                $origin = $this->request->getGet('origin');
                $destination = $this->request->getGet('destination');
                $weight = $this->request->getGet('weight');
                $courier = $this->request->getGet('courier');
                $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
                return $this->response->setJSON($data);
            }
        }

        private function rajaongkircost($origin, $destination, $weight, $courier)
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
                CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: ".$this->apiKey,
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return $response;
        }


        private function rajaongkir($method, $id_province=null)
        {
            $endPoint = $this->url.$method;

            if($id_province!=null)
            {
                $endPoint = $endPoint."?province=".$id_province;
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $endPoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                "key: ".$this->apiKey
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return $response;
        } 

        public function buy()
        { 
            if($this->request->getPost())
            {
                $data = $this->request->getPost(); 

                $transaksiModel = new \App\Models\TransaksiModel(); 
                $transaksiDetailModel = new \App\Models\TransaksiDetailModel(); 
        
                $dataForm = [
                    'username' => $this->request->getPost('username'),
                    'total_harga' => $this->request->getPost('total_harga'),
                    'alamat' => $this->request->getPost('alamat'),
                    'ongkir' => $this->request->getPost('ongkir'),
                    'status' => 0,
                    'created_by' => $this->request->getPost('username'),
                    'created_date' => date("Y-m-d H:i:s")
                ];

                $transaksiModel->insert($dataForm);

                $last_insert_id = $transaksiModel->getInsertID();

                foreach($this->cart->contents() as $value){
                    $dataFormDetail = [
                        'id_transaksi' => $last_insert_id,
                        'id_barang' => $value['id'], 
                        'jumlah' => $value['qty'],
                        'diskon' => 0,
                        'subtotal_harga' => $value['qty']*$value['price'],
                        'created_by' => $this->request->getPost('username'),
                        'created_date' => date("Y-m-d H:i:s")
                    ]; 

                    $transaksiDetailModel->insert($dataFormDetail);
                }

                $this->cart->destroy();
                
                session()->setflashdata('success', 'Pesanan berhasil dibuat');
                return redirect()->to(base_url('keranjang'));
            }
        }
    }