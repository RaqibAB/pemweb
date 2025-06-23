<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Buku: <?= esc($buku['judul_buku']); ?></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Judul Buku</dt>
                    <dd class="col-sm-9"><?= esc($buku['judul_buku']); ?></dd>

                    <dt class="col-sm-3">Pengarang</dt>
                    <dd class="col-sm-9"><?= esc($buku['pengarang']); ?></dd>

                    <dt class="col-sm-3">Penerbit</dt>
                    <dd class="col-sm-9"><?= esc($buku['penerbit']); ?></dd>

                    <dt class="col-sm-3">Tahun Terbit</dt>
                    <dd class="col-sm-9"><?= esc($buku['tahun_terbit']); ?></dd>

                    <dt class="col-sm-3">Kategori</dt>
                    <dd class="col-sm-9"><span class="badge bg-info"><?= esc($buku['nama_kategori']); ?></span></dd>

                    <dt class="col-sm-3">Stok Tersedia</dt>
                    <dd class="col-sm-9"><?= esc($buku['jumlah_stok']); ?></dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="/buku" class="btn btn-secondary btn-sm">Kembali ke Daftar Buku</a>
                <a href="/buku/edit/<?= $buku['id_buku']; ?>" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>