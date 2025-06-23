<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="col-lg-6">
    <form action="/kategori/create" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>" autofocus>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_kategori') ?>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/kategori" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?>