<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<div class="row">
    <?php foreach ($produks as $index => $produk) : ?>
        <div class="col-lg-6">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $produk['id']);
            echo form_hidden('nama', $produk['nama']);
            echo form_hidden('harga', $produk['harga']);
            echo form_hidden('foto', $produk['foto']);
            ?>
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo base_url() . "public/img/" . $produk['foto'] ?>" alt="..." width="300px">
                    <h5 class="card-title"><?php echo $produk['nama'] ?><br><?php echo number_to_currency($produk['harga'], 'IDR') ?></h5>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>