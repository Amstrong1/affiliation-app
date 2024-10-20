<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- FOOTER -->
        <footer class="bg-black text-white py-8 mt-10">
            <div class="container mx-auto grid grid-cols-3 gap-6">
                <div>
                    <img src="/path-to-logo.jpg" alt="Woway Logo" class="h-10">
                    <p class="text-sm mt-4">Woway vous permet de vous connecter directement avec des professionnels
                        et
                        prestataires de services, quel que soit leur domaine ou lieu de travail.</p>
                </div>
                <div>
                    <h4 class="font-bold">Lien rapides</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="#">Prestataires de services</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Catégorie de service</a></li>
                        <li><a href="#">Freelance en ligne</a></li>
                        <li><a href="#">Service de livraison</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold">Notre contact</h4>
                    <p class="mt-4 text-sm">contact@woway.co</p>
                    <p class="text-sm">00229 69557871</p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#"><img src="/path-to-social-icon.jpg" alt="Facebook" class="h-6"></a>
                        <a href="#"><img src="/path-to-social-icon.jpg" alt="LinkedIn" class="h-6"></a>
                        <a href="#"><img src="/path-to-social-icon.jpg" alt="WhatsApp" class="h-6"></a>
                        <a href="#"><img src="/path-to-social-icon.jpg" alt="YouTube" class="h-6"></a>
                    </div>
                </div>
            </div>
            <div class="mt-6 text-center text-xs text-gray-500">
                <p>&copy; 2024 Woway. Tous droits réservés.</p>
                <p>Termes et Conditions d'utilisation | Politique de confidentialité</p>
            </div>
        </footer>
    </div>
</body>

</html>
