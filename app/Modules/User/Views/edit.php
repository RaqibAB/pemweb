<?= $this->extend('layout/template') ?>
<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="col-lg-8">
    <form action="<?= site_url('user/update/'.$user['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('nama_lengkap', $user['nama_lengkap']) ?>">
            <div class="invalid-feedback"><?= $validation->getError('nama_lengkap') ?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email', $user['email']) ?>">
            <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>" name="role">
                <option value="admin" <?= (old('role', $user['role']) == 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="anggota" <?= (old('role', $user['role']) == 'anggota') ? 'selected' : '' ?>>Anggota</option>
            </select>
            <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
        </div>
        
        <button type="submit" class="btn btn-primary">Ubah Data</button>
        <a href="<?= site_url('user') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?>