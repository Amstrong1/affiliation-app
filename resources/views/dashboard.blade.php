<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- MAIN CONTENT -->
            <div class="container mx-auto py-10 flex">

                <!-- SIDEBAR -->
                <aside class="w-1/4 bg-white rounded-lg shadow-md p-6">
                    <nav>
                        <ul class="space-y-4">
                            <li><a href="#" class="font-bold text-gray-700">Mon Profil</a></li>
                            <li><a href="#" class="text-gray-600">Mes services</a></li>
                            <li><a href="#" class="text-gray-600">Mes favoris</a></li>
                            <li><a href="#" class="text-gray-600">Ma prestation</a></li>
                            <li><a href="#" class="text-gray-600">Perfect Profil</a></li>
                            <li><a href="#" class="text-gray-600">Partager mon profil</a></li>
                            <li><a href="#" class="text-gray-600">Mes catalogues</a></li>
                            <li><a href="#" class="text-gray-600">Vérification de compte</a></li>
                        </ul>
                    </nav>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-700">Crédit</h3>
                        <div class="bg-gray-100 p-4 rounded-lg mt-2">
                            <p class="text-2xl font-bold text-center">{{ auth()->user()->balance }}<span
                                    class="text-xs">WW</span></p>
                            <p class="text-sm text-center text-gray-500">Les crédits Woway vous permettent d'acheter des
                                abonnements et services.</p>
                            <div class="mt-4 space-y-2">
                                <p class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <span>🎁</span>
                                    <span>Inviter un nouveau utilisateur et obtenez <strong>10WW</strong></span>
                                </p>
                                <p class="flex items-center space-x-2 text-gray-600 text-sm">
                                    <span>🎁</span>
                                    <span>Recevez <strong>100WW</strong> après le premier abonnement de votre
                                        invité</span>
                                </p>
                                <input class="p-2 rounded-lg text-xs w-full" id="code" type="text"
                                    value="{{ $referral_link }}" readonly onclick="this.select();">
                                <button onclick="copyToClipboard()"
                                    class="bg-blue-500 text-white text-sm font-semibold py-2 px-4 rounded-lg mt-4 w-full">
                                    Copier le lien pour inviter vos proches maintenant
                                </button>
                            </div>
                        </div>
                        <form class="mt-4" action="{{ route('balance') }}" method="post">
                            @csrf
                            <span class="font-semibold">Recharger mon compte</span>
                            <div class="grid gap-4">
                                <input name='amount' class="rounded px-4 py-2" type="number" placeholder="Montant">
                                <button class="rounded px-4 py-2 border-0 bg-blue-500 text-white" type="submit">Recharger</button>
                            </div>
                        </form>
                    </div>

                    <a href="#"
                        class="block bg-red-500 text-white text-center font-semibold py-2 px-4 rounded-lg mt-10">
                        Déconnexion
                    </a>
                </aside>

                <!-- PROFILE SECTION -->
                <section class="w-3/4 bg-white rounded-lg shadow-md p-6 ml-8">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden">
                            <img src="/path-to-profile-image.jpg" alt="User Image" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                            {{-- <p class="text-gray-600">+229 69557871</p> --}}
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="mt-4">
                                <button
                                    class="text-blue-500 border border-blue-500 py-1 px-3 rounded-lg text-sm">Modifier
                                    votre numéro de téléphone</button>
                                <button
                                    class="text-blue-500 border border-blue-500 py-1 px-3 rounded-lg text-sm ml-4">Modifier
                                    votre mot de passe</button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-lg font-semibold text-gray-700">Information personnelle</h3>
                        <form action="#" method="POST" class="mt-6 space-y-4">
                            <div class="flex space-x-6">
                                <input type="text" placeholder="Nom"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                                <input type="text" placeholder="Prénom"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div class="flex space-x-6">
                                <input type="text" placeholder="Email"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                                <input type="text" placeholder="Contact"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div class="flex space-x-6">
                                <input type="text" placeholder="Adresse"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                                <input type="text" placeholder="Ville"
                                    class="w-1/2 p-2 border border-gray-300 rounded-lg">
                            </div>
                            <textarea class="w-full p-2 border border-gray-300 rounded-lg" rows="4" placeholder="Biographie"></textarea>

                            <button class="bg-blue-500 text-white py-2 px-6 rounded-lg font-semibold">Mettre à jour mes
                                informations</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById('code');
        copyText.select();
        document.execCommand("copy");
        alert("Lien copié !");
    }
</script>
