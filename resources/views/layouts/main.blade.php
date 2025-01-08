<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css">
        <script src="js/script.js"></script>
    </head> 
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="\img\Livre_Expresso_brand.png" alt="Alex Events">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">Meus Eventos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a href="/logout" 
                                        class="nav-link" 
                                        onclick="
                                            event.preventDefault();
                                            this.closest('form').submit();">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link">Cadastrar</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <p>Alex Events &copy; 2024</p>
        </footer>
        <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
    </body>
</html>
