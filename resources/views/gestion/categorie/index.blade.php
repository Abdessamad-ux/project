<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
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
        .table th, .table td {
            vertical-align: middle;
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
        .category-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .action-icons {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .action-icons i {
            cursor: pointer;
            font-size: 1.2rem;
        }
        .action-icons i:hover {
            color: #dc3545;
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
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i><span>Tableau de bord</span></a>
                    <a class="nav-link" href="{{ route('gestion.produit.index') }}"><i class="fas fa-box me-2"></i><span>Gestion des produits</span></a>
                    <a class="nav-link" href="{{ route('ingredients.index') }}"><i class="fas fa-carrot me-2"></i><span>Gestion des ingrédients</span></a>
                    <a class="nav-link active" href="{{ route('categories.index') }}"><i class="fas fa-folder me-2"></i><span>Gestion des catégories</span></a>
                    <a class="nav-link" href="{{ route('promo_codes.index') }}"><i class="fas fa-tags me-2"></i><span>Code promo</span></a>
                </div>
            </nav>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Gestion des catégories</h2>
                </div>
                
                <div class="card p-3">
                    <div class="d-flex justify-content-end align-items-center mb-3">
                        <div class="input-group w-25 me-3">
                            <input type="text" class="form-control" placeholder="Rechercher" id="searchInput">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <a href="{{ route('categories.create') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>Nouvelle catégorie
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Meta Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            @if($category->image)
                                                <img src="{{ Storage::url($category->image) }}" class="category-img" alt="{{ $category->name }}">
                                            @else
                                                <img src="{{ asset('images/default.jpg') }}" class="category-img" alt="Default">
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->meta_title }}</td>
                                        <td>
                                            <div class="action-icons">
                                                <i class="fas fa-arrows-alt-v" title="Changer la place"></i>
                                                <a href="{{ route('categories.edit', $category) }}"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent p-0" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
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

            // Fonctionnalité de tri
            new Sortable(document.querySelector('tbody'), {
                animation: 150,
                onEnd: function(evt) {
                    console.log('Ligne déplacée de ' + evt.oldIndex + ' vers ' + evt.newIndex);
                }
            });

            // Fonctionnalité de recherche
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('categoriesTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) { // Commence à 1 pour ignorer l'en-tête
                    const name = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                    const description = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
                    const metaTitle = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase();

                    if (name.includes(searchTerm) || description.includes(searchTerm) || metaTitle.includes(searchTerm)) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
</body>
</html>