<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<style>
    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .clamp.one-line {
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo-et-texte-orange-sur-fond-blanc.svg" alt="lescollectionneurs Logo" width="250" height="auto">
                </a>
            </div>

            <div class="mt-8 md:mt-0">
                <a href="/" class="text-xs font-bold uppercase">Espace Clients</a>

                <a href="#" class="ml-3 rounded-full text-xs font-semibold py-3 px-5" style="background-color: #ff8300;color:white">
                    Devenez Collectionneur
                </a>
            </div>
        </nav>

        {{ $slot }}

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="https://media.lescollectionneurs.com/lc-content/images/logos/fr/smartphone.svg" alt="" class="mx-auto -mb-6" style="width: 100px;margin-bottom:25px;">
            <h5 class="text-3xl">Abonnez vous à la Newsletter</h5>
            <p class="text-sm mt-3">Merci de saisir votre adresse email</br> et valider votre inscription</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="#" class="lg:flex text-sm">
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" type="text" placeholder="Votre adresse email"
                                   class="lg:bg-transparent py-2 lg:py-0  focus-within:outline-none" style="width:350px;text-align:center;">
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8" style="background-color:#ff8300;"
                        >
                            Je m'inscris
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>
</body>
