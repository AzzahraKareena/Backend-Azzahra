<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
</head>
<body>
    <form method="POST" action="<?= base_url('insertproduct') ?>">
        <label for="nama_product">Nama Produk</label>
        <input id="nama_product" name="nama_product" type="text" />
        <label for="description">Deskripsi Produk</label>
        <input id="description" name="description" type="text" />
        <button type="submit">Insert</button>
    </form>
</body>
</html>
