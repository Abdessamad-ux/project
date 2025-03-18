<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        .btn-custom {
            background-color: #dc3545;
            color: white;
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
        .product-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: block;
        }
        .form-label {
            font-weight: bold;
        }
        .back-link {
            color: #dc3545;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="text-center">
                    <div class="logo"></div>
                </div>
                <div class="nav flex-column">
                    <a class="nav-link" href="{{ url('tableau') }}"><i class="fas fa-tachometer-alt me-2"></i><span>Tableau de bord</span></a>
                    <a class="nav-link active" href="{{ route('gestion.produit.index') }}"><i class="fas fa-box me-2"></i><span>Gestion des produits</span></a>
                    <a class="nav-link" href="{{ url('gestion_interg') }}"><i class="fas fa-carrot me-2"></i><span>Gestion des ingrédients</span></a>
                    <a class="nav-link" href="{{ url('gestion_categ') }}"><i class="fas fa-folder me-2"></i><span>Gestion des catégories</span></a>
                    <a class="nav-link" href="{{ url('code_promo') }}"><i class="fas fa-tags me-2"></i><span>Code promo</span></a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2>Ajouter produit</h2>
                        <a href="{{ route('gestion.produit.index') }}" class="back-link">← Retour</a>                    </div>
                </div>

                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-6 text-center">
                        <img src="{{ asset('images/image copy.png') }}" class="product-image" alt="Image produit">                        </div>
                        <div class="col-md-6">
                        <form action="{{ route('gestion.produit.store') }}" method="POST">                                @csrf
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom du produit" value="{{ old('nom') }}">
                                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{ old('description') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="emporter" class="form-label">Emporter</label>
                                    <input type="text" class="form-control" id="emporter" name="emporter" placeholder="Prix emporter (ex: 15,00€)" value="{{ old('emporter') }}">
                                    @error('emporter') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="livraison" class="form-label">Livraison</label>
                                    <input type="text" class="form-control" id="livraison" name="livraison" placeholder="Prix livraison (ex: 15,00€)" value="{{ old('livraison') }}">
                                    @error('livraison') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ingredients" class="form-label">Ingrédients</label>
                                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Ingrédients (ex: Salade, Olive, Sauce)" value="{{ old('ingredients') }}">
                                    @error('ingredients') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre</label>
                                    <input type="text" class="form-control" id="title" name="titre" placeholder="Titre" value="{{ old('titre') }}">
                                    @error('titre') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-custom w-100">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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