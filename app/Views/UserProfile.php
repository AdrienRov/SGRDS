<main>

    <h1 class="text-2xl font-bold">Mon profile</h1>
    <p class="text-xl font-bold">Informations personnelles</p>

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
                        <input type="submit" value="Modifier" class="px-32 py-1 bg-orange-400" />
                    </td>
                </tr>
            </table>

        </form>





</main>