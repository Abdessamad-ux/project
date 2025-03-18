<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Ingrédients</title>
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
                    <a class="nav-link active" href="{{ route('ingredients.index') }}"><i class="fas fa-carrot me-2"></i><span>Gestion des ingrédients</span></a>
                    <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-folder me-2"></i><span>Gestion des catégories</span></a>
                    <a class="nav-link" href="{{ route('promo_codes.index') }}"><i class="fas fa-tags me-2"></i><span>Code promo</span></a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Gestion des ingredients</h2>
                </div>
                <p class="text-muted">Veuillez selectionner un ingrédient pour votre site</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 mb-4">
                            <h5 id="formTitle">Nouveau ingrédient</h5>
                            <form id="ingredientForm" action="{{ route('ingredients.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" id="ingredientId">
                                <div class="mb-3">
                                    <label for="nomFr" class="form-label">Nom (Fr)</label>
                                    <input type="text" class="form-control" id="nomFr" name="nom_fr" placeholder="Nom (Fr)" value="{{ old('nom_fr') }}">
                                    @error('nom_fr') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomEn" class="form-label">Nom (En)</label>
                                    <input type="text" class="form-control" id="nomEn" name="nom_en" placeholder="Nom (En)" value="{{ old('nom_en') }}">
                                    @error('nom_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomNl" class="form-label">Nom (Nl)</label>
                                    <input type="text" class="form-control" id="nomNl" name="nom_nl" placeholder="Nom (Nl)" value="{{ old('nom_nl') }}">
                                    @error('nom_nl') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-custom w-100" id="formButton">Ajouter</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card p-3">
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Liste des ingrédients</h5>
                                <div class="input-group w-25">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Rechercher">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="ingredientsTable">
                                    <thead>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Nom (Fr)</th>
                                            <th>Nom (En)</th>
                                            <th>Nom (Nl)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ingredients as $ingredient)
                                        <tr>
                                            <td>{{ $ingredient->id }}</td>
                                            <td>{{ $ingredient->nom_fr }}</td>
                                            <td>{{ $ingredient->nom_en }}</td>
                                            <td>{{ $ingredient->nom_nl }}</td>
                                            <td>
                                                <i class="fas fa-arrows-alt-v me-2" title="Changer la place"></i>
                                                <i class="fas fa-edit me-2 edit-ingredient" 
                                                   data-id="{{ $ingredient->id }}" 
                                                   data-nom-fr="{{ $ingredient->nom_fr }}" 
                                                   data-nom-en="{{ $ingredient->nom_en }}" 
                                                   data-nom-nl="{{ $ingredient->nom_nl }}"></i>
                                                <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cet ingrédient ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $ingredients->links() }}
                        </div>
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

            new Sortable(document.querySelector('tbody'), {
                animation: 150,
                onEnd: function(evt) {
                    console.log('Ligne déplacée de ' + evt.oldIndex + ' vers ' + evt.newIndex);
                }
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('ingredientsTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    let match = false;

                    for (let j = 0; j < cells.length - 1; j++) {
                        const cellText = cells[j].textContent.toLowerCase();
                        if (cellText.includes(filter)) {
                            match = true;
                            break;
                        }
                    }

                    rows[i].style.display = match ? '' : 'none';
                }
            });

            // Edit ingredient functionality
            document.querySelectorAll('.edit-ingredient').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nomFr = this.getAttribute('data-nom-fr');
                    const nomEn = this.getAttribute('data-nom-en');
                    const nomNl = this.getAttribute('data-nom-nl');

                    document.getElementById('formTitle').innerText = 'Modifier ingrédient';
                    document.getElementById('formButton').innerText = 'Modifier';
                    document.getElementById('ingredientId').value = id;
                    document.getElementById('nomFr').value = nomFr;
                    document.getElementById('nomEn').value = nomEn;
                    document.getElementById('nomNl').value = nomNl;
                    document.getElementById('ingredientForm').action = `/ingredients/${id}`;
                    
                    let methodInput = document.getElementById('ingredientForm').querySelector('input[name="_method"]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        document.getElementById('ingredientForm').appendChild(methodInput);
                    }
                    methodInput.value = 'PUT';
                });
            });
        });

        function resetForm() {
            document.getElementById('formTitle').innerText = 'Nouveau ingrédient';
            document.getElementById('formButton').innerText = 'Ajouter';
            document.getElementById('ingredientId').value = '';
            document.getElementById('nomFr').value = '';
            document.getElementById('nomEn').value = '';
            document.getElementById('nomNl').value = '';
            document.getElementById('ingredientForm').action = '{{ route("ingredients.store") }}';
            let methodInput = document.getElementById('ingredientForm').querySelector('input[name="_method"]');
            if (methodInput) methodInput.value = 'POST';
        }
    </script>
</body>
</html>