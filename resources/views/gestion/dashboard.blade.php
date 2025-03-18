<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Styles personnalisés */
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
            transition: width 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px !important;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        .sidebar .nav-link.active {
            background-color: #dc3545;
            color: white;
            border-radius: 10px;
        }
        .logo {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #ff4d6d, #ff8c00, #ffd700);
            border-radius: 50%;
            margin: 20px auto;
        }
        .sidebar.collapsed .logo {
            width: 50px;
            height: 50px;
        }
        .main-content {
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .toggle-btn {
            cursor: pointer;
            font-size: 1.5rem;
            margin: 10px;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-dashboard {
            transition: transform 0.2s;
        }
        .card-dashboard:hover {
            transform: scale(1.05);
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 2rem;
            color: #dc3545;
        }
        /* Modified styles for <i> tags */
        i {
            font-size: 1.3rem; /* Slightly larger size */
            margin-right: 8px; /* Adjusted spacing */
            transition: transform 0.2s ease; /* Smooth transition for hover effect */
        }
        i:hover {
            transform: rotate(15deg); /* Slight rotation on hover */
        }
        .sidebar .nav-link i {
            color: #666; /* Different color for sidebar icons */
        }
        .sidebar .nav-link.active i {
            color: white; /* White color for active link icons */
        }
        .card-body i {
            margin-bottom: 10px; /* Increased spacing below card icons */
            font-size: 2.5rem; /* Larger size for card icons */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <i class="fas fa-bars toggle-btn" id="toggleSidebar"></i>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bell me-2"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-cog"></i></a>
                    </li>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="text-center">
                    <div class="logo"></div>
                </div>
                <div class="nav flex-column">
                    <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i><span>Tableau de bord</span></a>
                    <a class="nav-link" href="{{ route('gestion.produit.index') }}"><i class="fas fa-box me-2"></i><span>Gestion des produits</span></a>
                    <a class="nav-link" href="{{ route('ingredients.index') }}"><i class="fas fa-carrot me-2"></i><span>Gestion des ingrédients</span></a>
                    <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-folder me-2"></i><span>Gestion des catégories</span></a>
                    <a class="nav-link" href="{{ route('promo_codes.index') }}"><i class="fas fa-tags me-2"></i><span>Code promo</span></a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Tableau de bord</h2>
                </div>
                <p class="text-muted">Veuillez sélectionner un thème pour votre site</p>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Carte Produits -->
                    <div class="col">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h5 class="card-title">Produits</h5>
                                <p class="card-text">{{ $productsCount }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Ingrédients -->
                    <div class="col">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h5 class="card-title">Ingrédients</h5>
                                <p class="card-text">{{ $ingredientsCount }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Catégories -->
                    <div class="col">
                        <div class="card card-dashboard">
                            <div class="card-body">
                    
                                <h5 class="card-title">Catégories</h5>
                                <p class="card-text">{{ $categoriesCount }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Codes promo -->
                    <div class="col">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h5 class="card-title">Codes promo</h5>
                                <p class="card-text">{{ $promoCodesCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <!-- Script pour basculer la sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleSidebar');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                if (sidebar.classList.contains('collapsed')) {
                    mainContent.classList.remove('col-md-9', 'col-lg-10');
                    mainContent.classList.add('col-md-11', 'col-lg-11');
                } else {
                    mainContent.classList.remove('col-md-11', 'col-lg-11');
                    mainContent.classList.add('col-md-9', 'col-lg-10');
                }
            });
        });
    </script>
</body>
</html>