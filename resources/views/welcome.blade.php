<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    
    <header class="container py-3">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-3">
                @auth
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i><span>dashboard</span></a>

                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-dark">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    
    <main class="container text-center">
        <h1 class="display-4 fw-bold">Bienvenue dans l'espace de la Gestion de Produits</h1>
        <p class="lead text-muted">Gerez vos produits efficacement avec notre plateforme.</p>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
