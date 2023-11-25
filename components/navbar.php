<nav class="navbar navbar-expand-lg" style='background: pink;'>
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src='/assets/logo.png' alt='logo'>Pet Oasis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Our pets
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="seniors.php">Seniors</a></li>
                        <li><a class="dropdown-item" href="all_pets.php">All pets</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if ($_SESSION['adm']) {
                    echo " <li class='nav-item'>
          <a class='nav-link' href='./create.php'>Add a pet</a>
          </li>
          <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='./dashboard.php'>Dashboard</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='../user/logout.php'>Log out</a>
        </li>
          ";
                } elseif ($_SESSION['user']) {
                    echo " <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='../user/logout.php'>Log out</a>
        </li>";
                }
                else {
                    echo "
          <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='../user/login.php'>Login</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='../user/register.php'>Sign up</a>
        </li>
        "  ;
                }
                ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
