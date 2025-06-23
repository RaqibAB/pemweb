<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/uas/public/index.php/buku/new" class="btn btn-sm btn-primary">Tambah Data Buku</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari judul, pengarang..." name="keyword"
                    value="<?= $keyword ?? '' ?>">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Kategori</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (5 * ($pager->getCurrentPage('buku') - 1)); ?>
            <?php foreach ($buku as $b): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $b['judul_buku']; ?></td>
                    <td><?= $b['nama_kategori']; ?></td>
                    <td><?= $b['pengarang']; ?></td>
                    <td><?= $b['jumlah_stok']; ?></td>
                    <td>
                        <a href="/uas/public/index.php/buku/edit/<?= $b['id_buku']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/buku/delete/<?= $b['id_buku']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $pager->links('buku', 'bootstrap_pagination') ?>

<?= $this->endSection() ?>