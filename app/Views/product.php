<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Products</h1>
    <button> <a href="/insertproducts"> Masukkan Produk </a></button>
    <table border="1" cellpadding ="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Product</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $p): ?>
            <tr>
                <td><?=$p->id?></td>
                <td><?=$p->nama_product?></td>
                <td><?=$p->description?></td>
                <td>
                    <a href="<?=base_url('edit-product/'.$p->id)?>">Edit</a>
                    <a href="<?=base_url('delete-product/'.$p->id)?>">Hapus</a>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</body>
</html>
