<?php
$avatar = isset($_COOKIE["avatar"]) ? $_COOKIE["avatar"] : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-uppercase" href="/home">PX Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['route'] ?? '') === 'forums' ? 'active' : ''; ?>" href="/forums">Forums</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['route'] ?? '') === 'popular' ? 'active' : ''; ?>" href="/popular">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['route'] ?? '') === 'mytopics' ? 'active' : ''; ?>" href="/mytopics">My Topics</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (!isset($_COOKIE["username"])): ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light rounded-pill me-2" href="/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light rounded-pill" href="/login">Sign in</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php $avatar ?>" alt="User Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <?php echo htmlspecialchars($_COOKIE["username"]); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item <?php echo ($_GET['route'] ?? '') === 'profile' ? 'active' : ''; ?>" href="/profile">My Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php echo ($_GET['route'] ?? '') === 'settings' ? 'active' : ''; ?>" href="/settings">Settings</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>