<main class="flex-1">
<div class="w-1/2 mx-auto">

<div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
    <h1 class="text-2xl font-bold">Mon profil</h1>
        <div class="mx-3 my-3">
        <p class="text-2xl font-bold py-3">Informations personnelles</p>

            <form action="<?= site_url('UserProfile/edit') ?>" method="post" enctype="multipart/form-data">

                <table class="flex justify-center">
                    <tr>
                        <td>
                            <input type="text" name="first_name" id="first_name" placeholder="Prénom" class=" py-1 border border-slate-300" value="<?= $user->first_name ?>" />
                        </td>
                        <td>
                            <input type="text" name="last_name" id="last_name" placeholder="Nom" class=" py-1 border border-slate-300" value="<?= $user->last_name ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="email" name="email" id="email" placeholder="Email" class="w-1/2 py-1 border border-slate-300 w-full" value="<?= $user->email ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" name="password" id="password" placeholder="Mot de passe" class="w-1/2 py-1 border border-slate-300 w-full" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier" class="w-1/2 py-1 my-2 text-white bg-orange hover:bg-orange-light cursor-pointer" />
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</main>