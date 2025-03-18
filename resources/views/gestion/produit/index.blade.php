<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
                <a class="nav-link active" href="{{ route('gestion.produit.index') }}"><i class="fas fa-box me-2"></i><span>Gestion des produits</span></a>
                    <a class="nav-link" href="{{ route('ingredients.index') }}"><i class="fas fa-carrot me-2"></i><span>Gestion des ingrédients</span></a>
                    <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-folder me-2"></i><span>Gestion des catégories</span></a>
                    <a class="nav-link" href="{{ route('promo_codes.index') }}"><i class="fas fa-tags me-2"></i><span>Code promo</span></a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Gestion des produits</h2>
                </div>
                <p class="text-muted">Veuillez selectionner un thème pour votre site</p>

                    <div class="d-flex justify-content-end align-items-center mb-3">
                        <div class="input-group w-25 me-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Rechercher">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <a href="{{ route('gestion.produit.create') }}"><button class="btn btn-custom"><i class="fas fa-plus me-2"></i>Nouveau produit</button></a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="productTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Emporter</th>
                                    <th>Livraison</th>
                                    <th>Ingrédients</th>
                                    <th>Titre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td><img src="{{ asset($product->image ?? 'images/image copy.png') }}" class="product-img" alt="Produit"></td>
                                    <td>{{ $product->nom }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->emporter }}€</td>
                                    <td>{{ $product->livraison }}€</td>
                                    <td>{{ $product->ingredients }}</td>
                                    <td>{{ $product->titre }}</td>
                                    <td>
                                        <div class="action-icons">
                                            <i class="fas fa-arrows-alt-v" title="Changer la place"></i>
                                            <a href="{{ route('gestion.produit.edit', $product->id) }}"><i class="fas fa-plus-circle"></i></a>
                                            <form action="{{ route('gestion.produit.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background:none; border:none; padding:0;"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>