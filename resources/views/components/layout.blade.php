<!doctype html>

<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Espace Client LesCollectionneurs</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
  <link rel="stylesheet" href="css/adminlte.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/app.css">
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
</head>

<body style="font-family: Open Sans, sans-serif">
  <section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
      <div>
        <a href="/">
          <img src="/images/logo-et-texte-orange-sur-fond-blanc.svg" alt="lescollectionneurs Logo" width="250" height="auto">
        </a>
      </div>

      <div class="mt-8 md:mt-0 flex items-center">
        <a href="/" class="text-xs font-bold uppercase">Espace Clients</a>

        @auth
        <span class="text-xs font-bold uppercase">&nbsp;&nbsp;|&nbsp;&nbsp;Bienvenue,
          <span class="user_name">{{ auth()->user()->name }}</span> !</span>

        <form method="POST" action="/logout" class="text-xs font-semibold text-blue-500 ml-6">
          @csrf
          <button type="submit">Déconnexion</button>
        </form>
        @else
        @if (Route::currentRouteName() != 'password.request' && Route::currentRouteName() != 'password.reset')
            <a href="/login" class="ml-3 rounded-full text-xs font-semibold py-3 px-5" style="background-color: #white;color:black;border:1px solid grey;">
            Connexion
            </a>
            <a href="/register" class="ml-3 rounded-full text-xs font-semibold py-3 px-5" style="background-color: #ff8300;color:white">
            Devenez Collectionneur
            </a>
        @endif
        @endauth

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
            <div class="lg:px-5 flex items-center newsletter-block">
              <label for="email" class="hidden lg:inline-block">
                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
              </label>

              <input id="email-newsletter" type="text" placeholder="Votre adresse email" class="lg:bg-transparent py-2 lg:py-0  focus-within:outline-none" style="width:350px;text-align:center;">
            </div>

            <button type="submit" class="transition-colors duration-300 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8" style="background-color:#ff8300;">
              <!--
                            <button type="submit"
                                class="transition-colors duration-300 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8" style="background-color:#ff8300;"
                        >
                        -->
              Je m'inscris
            </button>
          </form>
        </div>
      </div>
    </footer>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
  </script>
  <script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
  <script src="/js/app.js"></script>
  <script src="/js/adminlte.js"></script>
</body>

</html>

