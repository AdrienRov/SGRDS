<main class="flex-1">
<div class="mx-5">

<div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
    <h1 class="text-2xl font-bold">Mon profile</h1>
        <div class="mx-3 my-3">
        <p class="text-2xl font-bold">Informations personnelles</p>

            <form action="<?= site_url('UserProfile/edit') ?>" method="post" enctype="multipart/form-data">

                <table>
                    <tr>
                        <td>
                            <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="px-32 py-1" value="<?= $user->first_name ?>" />
                        </td>
                        <td>
                            <input type="text" name="last_name" id="last_name" placeholder="Nom" class="px-32 py-1" value="<?= $user->last_name ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="email" name="email" id="email" placeholder="Email" class="px-32 py-1 w-full" value="<?= $user->email ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" name="password" id="password" placeholder="Mot de passe" class="px-32 py-1 w-full" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier" class="px-32 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</main>