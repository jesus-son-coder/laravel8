<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 border-gray-200 rounded-xl">

            <h1 class="text-center font-bold text-xl">Réinitialiser mon Mot de passe</h1>

            <form method="POST" action="{{ route('password.update') }}" class="mt-10">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="email"
                    >
                        Votre adresse Email
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                        type="email"
                        name="email"
                        id="email-reset"
                        value="{{ $email ?? old('email') }}"
                        placeholder="Saisissez votre adresse Email"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="email"
                    >
                        Nouveau mot de passe
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                        type="password"
                        name="password"
                        id="password-reset"
                        placeholder="Saisissez votre nouveau mot de passe"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="email"
                    >
                        Confirmer le mot de passe
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Saisissez à nouveau le mot de passe"
                        required
                    >
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <button type="submit" class="text-white rounded py-2 px-4 hover:bg-blue-500" style="background-color:#ff8300;">
                        Réinitialiser mon Mot de passe
                    </button>
                </div>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-xs mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>
        </main>
    </section>
</x-layout>
