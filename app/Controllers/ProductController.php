<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;

class ProductController extends BaseController {

    use ResponseTrait;

    public function __construct(){
        $this->product = new ProductModel();
    }
    public function insertProduct(){
        $data = [
            'nama_product' => $this->request->getPost('nama_product'),
            'description' => $this->request->getPost('description')
        ];

        $this->product->insertProductORM($data);
        return redirect()->to('products');
    }

    public function insertProductAPI(){
        $requestData = $this->request->getJSON();

        $validation = $this->validate([
            'nama_product' => "required",
            'description' => "required"
        ]);

        if(!$validation){
            $this->response->setStatusCode(400);
            return $this->response->setJSON([
                'code' => 400,
                'status' => 'Not Found',
                'data' => null
            ]);
        }
        $data = [
            'nama_product' => $requestData->nama_product,
            'description' => $requestData->description
        ];

        $insert = $this->product->insertProductORM($data);
        if ($insert){

            return $this->respond([
                'code' => 200,
                'status' => 'OK',
                'data' => $data
            ]);
        } else{
            $this->response->setStatusCode(500);
            return $this->response->setJSON([
                'code' => 500,
                'status' => 'Not Found',
                'data' => null
            ]);
        }

    }

    public function insertPage(){
        return view('insert_product');
    }
    
    public function readProduct(){
        $products = $this->product->findAll();
        $data = [
            'data' => $products
        ];

        return view('product', $data);
    }

    public function readProductsApi(){
        $products = $this->product->findAll();

        return $this->respond([
            'code' => 200,
            'status' => 'OK',
            'data' => $products
        ]
        );
    }

    public function getProduct($id){
        $product = $this->product->where('id', $id)->first();
        $data = [
            'product' => $product
        ];
        return view('edit_product', $data);
    }

    public function getProductApi($id){
        $product = $this->product->where('id', $id)->first();
        if(!$product){
            $this->response->setStatusCode(404);
            return $this->response->setJSON([
                'code' => 404,
                'status' => 'Not Found',
                'data' => null
            ]);
        }
        return $this->response->setJSON([
            'code' => 200,
            'status' => 'OK',
            'data' => $product
        ]);
    }

    public function updateProduct($id){
        $nama_product = $this->request->getVar('nama_product');
        $description = $this->request->getVar('description');
        $data = [
            'nama_product' => $nama_product,
            'description' => $description
        ];
        $this->product->update($id, $data);
        return redirect()->to(base_url("products"));
    }

    public function updateProductAPI($id) {
        $data = $this->request->getJSON();
    
        // Pastikan bahwa field yang diperlukan ada dalam permintaan
        if (!isset($data->nama_product) || !isset($data->description)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Permintaan Tidak Valid']);
        }
    
        $nama_product = $data->nama_product;
        $description = $data->description;
    
        $updatedData = [
            'nama_product' => $nama_product,
            'description' => $description
        ];
    
        // Mengasumsikan bahwa $this->product adalah model Anda
        $this->product->update($id, $updatedData);
    
        // Anda dapat menyesuaikan respons sesuai kebutuhan Anda
        return $this->response->setStatusCode(200)->setJSON(['message' => 'Produk berhasil diperbarui']);
    }
    

    public function deleteProduct($id){
        $this->product->delete($id);
        return redirect()->to(base_url("products"));

    }
}