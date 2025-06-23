<div class="position-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/buku">
                <i class="bi bi-book"></i>
                Data Buku
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kategori">
                <i class="bi bi-tags"></i>
                Data Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-arrow-down-up"></i>
                Data Peminjaman
            </a>
        </li>
    </ul>

    <?php if(session()->get('user_role') === 'admin'): ?>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>ADMINISTRATOR</span>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="/users">
                <i class="bi bi-people"></i>
                Manajemen User
            </a>
        </li>
    </ul>
    <?php endif; ?>
</div>