<main class="flex flex-1 justify-center items-center">
<form id="loginForm">
    <div class="mb-4 text-red-500" id="error">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-400">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Mot de passe</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-400">
    </div>

    <button type="button" id="submitBtn" class="w-full bg-orange hover:bg-orange-light text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
        Connexion
    </button>

    <button type="button" id="resetPassword" class="mt-2 w-full bg-orange hover:bg-orange-light text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue">
        Mot de passe oublié
    </button>
</form>
</main>
