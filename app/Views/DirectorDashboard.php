<?php

function getResourceById($resources, $id)
{
    foreach ($resources as $resource) {
        if ($resource->id == $id) {
            return $resource;
        }
    }
}

?>

<main>
<h1 class="h1">Dashboard du directeur</h1>

<div class="flex justify-center">
    <h1>Semeestres</h1>
    <div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
        <div class="flex flex-row">
            <div class="flex flex-col gap-1">

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Année</th>
                            <th class="px-4 py-2">Semestre</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($semesters as $semester) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $semester->annee ?></td>
                                <td class="border px-4 py-2"><?= $semester->semester ?></td>
                                <td class="border px-4 py-2">
                                    <a href="<?= site_url('DirectorDashboard/supprimerSemestre/' . $semester->id) ?>" class="px-4 py-2 bg-red-400">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="<?= site_url('DirectorDashboard/ajoutSemestre') ?>" method="post" enctype="multipart/form-data">

                    <input type="text" name="annee" id="annee" placeholder="Année" class="px-32 py-1" />
                    <input type="number" name="semester" id="semester" placeholder="Semestre" class="px-32 py-1" />

                    <input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
                </form>
            </div>
        </div>
    </div>
</div>


<div class="flex justify-center">

    <h1>Resources</h1>
    <div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
        <div class="flex flex-row">
            <div class="flex flex-col gap-1">

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resources as $resource) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $resource->name ?></td>
                                <td class="border px-4 py-2">
                                    <a href="<?= site_url('DirectorDashboard/supprimerResource/' . $resource->id) ?>" class="px-4 py-2 bg-red-400">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="<?= site_url('DirectorDashboard/ajoutResource') ?>" method="post" enctype="multipart/form-data">

                    <input type="text" name="name" id="name" placeholder="Nom" class="px-32 py-1" />

                    <input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="flex justify-center">
    <h1>Utilisateurs</h1>
    <div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
        <div class="flex flex-row">
            <div class="flex flex-col gap-1">

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Rôle</th>
                            <th class="px-4 py-2">Matières</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $user->last_name ?></td>
                                <td class="border px-4 py-2"><?= $user->first_name ?></td>
                                <td class="border px-4 py-2"><?= $user->email ?></td>
                                <td class="border px-4 py-2"><?= $user->type == 0 ? 'Professeur' : 'Directeur' ?></td>
                                <td class="border px-4 py-2">
                                    <?php foreach ($userResources as $userResource) { ?>
                                        <?php if ($userResource->user_id == $user->id) {
                                            $res = getResourceById($resources, $userResource->resource_id);
                                            ?>
                                            <?= $res->name ?>
                                            <a href="<?= site_url('DirectorDashboard/supprimerUserResource/' . $userResource->id) ?>" class="px-4 py-2 bg-red-400">Enlever</a>
                                            <br />
                                        <?php } ?>
                                    <?php } ?>
                                    <form action="<?= site_url('DirectorDashboard/ajoutUserResource') ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" id="user_id" value="<?= $user->id ?>" />
                                        <select name="resource_id" id="resource_id" class="px-32 py-1">
                                            <?php foreach ($resources as $resource) {
                                                $found = false;
                                                foreach ($userResources as $userResource) {
                                                    if ($userResource->user_id == $user->id && $userResource->resource_id == $resource->id) {
                                                        $found = true;
                                                    }
                                                }
                                                if (!$found) {
                                            ?>
                                                    <option value="<?= $resource->id ?>"><?= $resource->name ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                        <input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
                                    </form>
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="<?= site_url('DirectorDashboard/supprimerUser/' . $user->id) ?>" class="px-4 py-2 bg-red-400">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="<?= site_url('DirectorDashboard/ajoutUser') ?>" method="post" enctype="multipart/form-data">

                    <input type="text" name="last_name" id="last_name" placeholder="Nom" class="px-32 py-1" />
                    <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="px-32 py-1" />
                    <input type="email" name="email" id="email" placeholder="Email" class="px-32 py-1" />
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="px-32 py-1" />
                    <select name="type" id="type" class="px-32 py-1">
                        <option value="0">Professeur</option>
                        <option value="1">Directeur</option>
                    </select>

                    <input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
                </form>
            </div>
        </div>
    </div>
</div>
<div class="flex justify-center">
    <h1>Etudiants</h1>
    <div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
        <div class="flex flex-row">
            <div class="flex flex-col gap-1">

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Promotion</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $student->first_name ?> <?= $student->last_name ?></td>
                                <td class="border px-4 py-2"><?= $student->email ?></td>
                                <td class="border px-4 py-2"><?= $student->promotion ?></td>
                                <td class="border px-4 py-2">
                                    <a href="<?= site_url('DirectorDashboard/supprimerStudent/' . $student->id) ?>" class="px-4 py-2 bg-red-400">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="<?= site_url('DirectorDashboard/ajoutStudent') ?>" method="post" enctype="multipart/form-data">

                    <input type="text" name="last_name" id="last_name" placeholder="Nom" class="px-32 py-1" />
                    <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="px-32 py-1" />
                    <input type="email" name="email" id="email" placeholder="Email" class="px-32 py-1" />
                    <input type="text" name="promotion" id="promotion" placeholder="Promotion" class="px-32 py-1" />

                    <input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
                </form>

                <h1>Importer des étudiants depuit un fichier CSV</h1>
                <form action="<?= site_url('DirectorDashboard/importStudents') ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="file" />
                    <input type="submit" value="Importer" class="px-32 py-1 bg-orange-400" />
                </form>

            </div>
        </div>
</div>


</main>

