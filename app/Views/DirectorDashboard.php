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

<main class="flex-1 px-44">
    <h1 class="text-3xl font-bold mx-3 my-3">Dashboard du directeur</h1>

    <!-- Tabs -->
    <div class="flex justify-center">
        <div class="tabs space-x-4">
            <button class="tablinks active inline-block p-4 bg-gray-100 rounded-t-lg active text-orange-800" onclick="openTab(event, 'semesters')">Semestres</button>
            <button class="tablinks inline-block p-4 bg-gray-100 rounded-t-lg active " onclick="openTab(event, 'resources')">Resources</button>
            <button class="tablinks inline-block p-4 bg-gray-100 rounded-t-lg active " onclick="openTab(event, 'users')">Utilisateurs</button>
            <button class="tablinks inline-block p-4 bg-gray-100 rounded-t-lg active " onclick="openTab(event, 'students')">Etudiants</button>
        </div>
    </div>

    <!-- Content for each tab -->
    <div class="flex flex-col items-center">
    <div id="semesters" class="tabcontent bg-zinc-300 rounded-lg px-16 mr-3 py-8" style="display: block;">
    <h1 class="text-2xl">Semestres</h1>
            <div class="flex flex-row">
                <div class="flex flex-col gap-1">
                    <table class="table-auto bg-white rounded-md">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Année</th>
                                <th class="px-4 py-2">Semestre</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($semesters as $semester) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $semester->annee ?></td>
                                    <td class="border px-4 py-2"><?= $semester->semester ?></td>
                                    <td class="border px-4 py-2">
                                        <a href="<?= site_url('DirectorDashboard/supprimerSemestre/' . $semester->id) ?>" class="px-4 py-1 text-white bg-red-600 hover:bg-red-700">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h1 class="text-xl">Ajouter un semestre</h1>

                    <form action="<?= site_url('DirectorDashboard/ajoutSemestre') ?>" method="post" enctype="multipart/form-data">

                        <input type="text" name="annee" id="annee" placeholder="Année" class="px-8 py-1" />
                        <input type="number" name="semester" id="semester" placeholder="Semestre" class="px-8 py-1" />

                        <input type="submit" value="Ajouter" class="px-8 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </form>
                </div>
            </div>
    </div>

    <div id="resources" class="tabcontent bg-zinc-300 rounded-lg px-16 mr-3 py-8">
    <h1 class="text-2xl">Resources</h1>
            <div class="flex flex-row">
                <div class="flex flex-col gap-1">
                <?php if (session('error')) : ?>
                    <div class="bg-red-500 text-white px-4 py-2 mb-4 rounded-md">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                        <table class="table-auto bg-white rounded-md">
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
                                <td class="border px-4 py-2 text-center">
                                    <a href="<?= site_url('DirectorDashboard/supprimerResource/' . $resource->id) ?>" class="px-4 py-1 text-white bg-red-600 hover:bg-red-700">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h1 class="text-xl">Ajouter une resource</h1>
                    <form action="<?= site_url('DirectorDashboard/ajoutResource') ?>" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" id="name" placeholder="Nom" class="px-8 py-1" />
                        <input type="submit" value="Ajouter" class="px-8 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </form>
                </div>
            </div>
    </div>

    <div id="users" class="tabcontent bg-zinc-300 rounded-lg px-16 mr-3 py-8">
    <h1 class="text-2xl">Utilisateurs</h1>
            <div class="flex flex-row">
                <div class="flex flex-col gap-1">

                    <table class="table-auto bg-white rounded-md">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nom</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Matières</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td class="border px-4 py-2">
                                        <?= $user->first_name ?> <?= $user->last_name ?>
                                        <?php if ($user->type == 0) { ?>
                                            <span class="px-2 py-1 bg-blue-400">Professeur</span>
                                        <?php } else { ?>
                                            <span class="px-2 py-1 bg-blue-400">Directeur</span>
                                        <?php } ?>
                                    </td>
                                    <td class="border px-4 py-2"><?= $user->email ?></td>
                                    <td class="border px-4 py-2">
                                        <?php foreach ($userResources as $userResource) { ?>
                                            <?php if ($userResource->user_id == $user->id) {
                                                $res = getResourceById($resources, $userResource->resource_id);
                                                ?>
                                                <?= $res->name ?>
                                                <a href="<?= site_url('DirectorDashboard/supprimerUserResource/' . $userResource->id) ?>" class="px- py-2 text-red-400">X</a>
                                                <br />
                                            <?php } ?>
                                        <?php } ?>
                                        <form action="<?= site_url('DirectorDashboard/ajoutUserResource') ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" id="user_id" value="<?= $user->id ?>" />
                                            <select name="resource_id" id="resource_id" class="px-8 py-1">
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
                                            <input type="submit" value="Ajouter" class="px-4 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                                        </form>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="<?= site_url('DirectorDashboard/supprimerUser/' . $user->id) ?>" class="px-4 py-1 text-white bg-red-600 hover:bg-red-700">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h1 class="text-xl">Ajouter un utilisateur</h1>

                    <form action="<?= site_url('DirectorDashboard/ajoutUser') ?>" method="post" enctype="multipart/form-data">

                        <div class="flex flex-row gap-1 mb-1">
                            <div class="flex flex-col gap-1">
                                <input type="text" name="last_name" id="last_name" placeholder="Nom" class="px-8 py-1" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="px-8 py-1" />
                            </div>

                        </div>

                        <div class="flex flex-row gap-1 mb-1">
                            <input type="email" name="email" id="email" placeholder="Email" class="px-8 py-1" />
                        </div>
                        <div class="flex flex-row gap-1 mb-1">
                            <input type="password" name="password" id="password" placeholder="Mot de passe" class="px-8 py-1" />
                        </div>
                        <select name="type" id="type" class="px-8 py-1">
                            <option value="0">Professeur</option>
                            <option value="1">Directeur</option>
                        </select>

                        <input type="submit" value="Ajouter" class="px-8 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </form>
                </div>
            </div>
    </div>

    <div id="students" class="tabcontent bg-zinc-300 rounded-lg px-16 mr-3 py-8">
    <h1 class="text-2xl">Etudiants</h1>
            <div class="flex flex-row">
                <div class="flex flex-col gap-1">

                    <table class="table-auto bg-white rounded-md">
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
                                        <a href="<?= site_url('DirectorDashboard/supprimerStudent/' . $student->id) ?>" class="px-4 py-1 text-white bg-red-600 hover:bg-red-700">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h1 class="text-xl">Ajouter un étudiant</h1>
                    <form action="<?= site_url('DirectorDashboard/ajoutStudent') ?>" method="post" enctype="multipart/form-data">

                        <input type="text" name="last_name" id="last_name" placeholder="Nom" class="px-8 py-1" />
                        <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="px-8 py-1" />
                        <input type="email" name="email" id="email" placeholder="Email" class="px-8 py-1" />
                        <input type="text" name="promotion" id="promotion" placeholder="Promotion" class="px-8 py-1" />

                        <input type="submit" value="Ajouter" class="px-8 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </form>

                    <h1 class="text-xl">Importer des étudiants depuit un fichier CSV</h1>
                    <form action="<?= site_url('DirectorDashboard/importStudents') ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" />
                        <input type="submit" value="Importer" class="px-8 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        //when page loads, show the first tab content and hide the rest
        document.getElementById("semesters").style.display = "block";
        document.getElementById("resources").style.display = "none";
        document.getElementById("users").style.display = "none";
        document.getElementById("students").style.display = "none";

        
        
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
                tablinks[i].className = tablinks[i].className.replace(" text-orange-800", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            evt.currentTarget.className += " text-orange-800";
        }
    </script>
</main>



