<?php
namespace App\Controllers;

use App\Models\ItemModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Items extends BaseController
{
    protected $itemModel;

    // Gunakan initController untuk cek login
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if (!session()->get('isLoggedIn')) {
            redirect()->to('/login')->send();
            exit;
        }

        $this->itemModel = new ItemModel();
    }

    public function index()
{
    $items = $this->itemModel->findAll();

    // Statistik umum
    $total_barang = count($items);
    $total_jenis = count(array_unique(array_column($items, 'type')));
    $stok_terbanyak = $this->itemModel->orderBy('quantity', 'DESC')->first();

    // Data untuk grafik: jumlah barang berdasarkan jenis
    $grafik_statistik = [];
    foreach ($items as $item) {
        $jenis = $item['type'];
        $jumlah = $item['quantity'];

        if (!isset($grafik_statistik[$jenis])) {
            $grafik_statistik[$jenis] = 0;
        }
        $grafik_statistik[$jenis] += $jumlah;
    }

    // Format data grafik untuk Google Charts
    $grafik_data = [['Jenis Barang', 'Jumlah']];
    foreach ($grafik_statistik as $jenis => $jumlah) {
        $grafik_data[] = [$jenis, $jumlah];
    }

    return view('items/index', [
        'items' => $items,
        'total_barang' => $total_barang,
        'total_jenis' => $total_jenis,
        'stok_terbanyak' => $stok_terbanyak,
        'grafik_data' => json_encode($grafik_data), // kirim ke view
    ]);
}



    public function create()
    {
        return view('items/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'           => 'required|min_length[3]',
            'quantity'       => 'required|integer',
            'price_per_unit' => 'required|decimal',
            'type'           => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->itemModel->save($this->request->getPost());
        return redirect()->to('/items')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data['item'] = $this->itemModel->find($id);
        return view('items/edit', $data);
    }

    public function update($id)
    {
        $this->itemModel->update($id, $this->request->getPost());
        return redirect()->to('/items')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->itemModel->delete($id);
        return redirect()->to('/items')->with('success', 'Data berhasil dihapus');
    }
}
