<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= site_url('kategori/new') ?>" class="btn btn-sm btn-primary">Tambah Kategori</a>
    </div>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <form action="<?= site_url('kategori') ?>" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari nama kategori..." name="keyword" value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $nomor; // Gunakan variabel nomor dari controller ?>
            <?php foreach($kategori as $k) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= esc($k['nama_kategori']); ?></td>
                <td>
                    <a href="<?= site_url('kategori/edit/'.$k['id_kategori']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?= site_url('kategori/'.$k['id_kategori']) ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?= $pager->links('kategori', 'bootstrap_pagination') ?>
</div>

<?= $this->endSection() ?>