<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="col-lg-8">
    <form action="<?= site_url('buku/update/' . $buku['id_buku']); ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku"
                value="<?= old('judul_buku', $buku['judul_buku']) ?>" autofocus>
        </div>
        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select class="form-select" name="id_kategori">
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>" <?= ($k['id_kategori'] == $buku['id_kategori']) ? 'selected' : ''; ?>><?= $k['nama_kategori'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang"
                value="<?= old('pengarang', $buku['pengarang']) ?>">
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit"
                value="<?= old('penerbit', $buku['penerbit']) ?>">
        </div>
        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                value="<?= old('tahun_terbit', $buku['tahun_terbit']) ?>">
        </div>
        <div class="mb-3">
            <label for="jumlah_stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok"
                value="<?= old('jumlah_stok', $buku['jumlah_stok']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Ubah Data</button>
        <a href="/uas/public/index.php/buku" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?>