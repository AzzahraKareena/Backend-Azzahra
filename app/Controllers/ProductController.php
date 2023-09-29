<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController {

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

    public function getProduct($id){
        $product = $this->product->where('id', $id)->first();
        $data = [
            'product' => $product
        ];
        return view('edit_product', $data);
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

    public function deleteProduct($id){
        $this->product->delete($id);
        return redirect()->to(base_url("products"));

    }
}