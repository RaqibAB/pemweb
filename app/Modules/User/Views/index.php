<?= $this->extend('layout/template') ?>
<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= site_url('user/new') ?>" class="btn btn-sm btn-primary">Tambah User</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($users as $user) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= esc($user['nama_lengkap']); ?></td>
                <td><?= esc($user['email']); ?></td>
                <td><span class="badge bg-light"><?= esc($user['role']); ?></span></td>
                <td>
                    <a href="<?= site_url('user/edit/'.$user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?= site_url('user/'.$user['id']) ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>