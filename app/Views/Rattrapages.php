<?php
function getSemesterById($semesters, $id)
{
    foreach ($semesters as $semester) {
        if ($semester->id == $id) {
            return $semester;
        }
    }
}

function getResourceById($resources, $id)
{
    foreach ($resources as $resource) {
        if ($resource->id == $id) {
            return $resource;
        }
    }
}

function getUserById($users, $id)
{
    foreach ($users as $user) {
        if ($user->id == $id) {
            return $user;
        }
    }
}
?>


<main>
    <h1 class="text-2xl font-bold">Rattrapages</h1>

    <div>
        <input type="text" name="search" id="search" placeholder="Rechercher" class="px-32 py-1" />
        <select name="semester" id="semester" class="px-32 py-1">
            <option value="">Tous les semestres</option>
            <?php foreach ($semesters as $semester) : ?>
                <option value="<?= $semester->semester ?>"><?= $semester->semester ?></option>
            <?php endforeach ?>
        </select>

        <select name="status" id="status" class="px-32 py-1">
            <option value="">Tous les états</option>
            <option value="0">Programmé</option>
            <option value="1">En cours</option>
            <option value="2">Neutralisé</option>
            <option value="3">Annulé</option>
            <option value="4">Passé</option>
        </select>

        <label for="mine">Mes rattrapages</label>
        <input type="checkbox" name="mine" id="mine" class="px-32 py-1" />
    </div>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Semestre</th>
                <th class="px-4 py-2">Ressource</th>
                <th class="px-4 py-2">Enseignant</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Etat</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exams as $exam) : ?>
                <tr x-data="<?= $exam->status ?>">
                    <td class="border px-4 py-2">S<?= getSemesterById($semesters, $exam->semester_id)->semester ?></td>
                    <td class="border px-4 py-2"><?= getResourceById($resources, $exam->resource_id)->name ?></td>
                    <td class="border px-4 py-2"><?= getUserById($users, $exam->user_id)->first_name ?> <?= getUserById($users, $exam->user_id)->last_name ?></td>
                    <td class="border px-4 py-2"><?= $exam->date ?></td>
                    <td class="border px-4 py-2">
                        <?php if ($exam->status == 0) : ?>
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 25.5-10.1 49.9-28.1 67.9L192 210.7l-67.9-67.9C106.1 124.9 96 100.4 96 75z"></path>
                        </svg>
                        <?php elseif ($exam->status == 1) : ?>
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"></path>
                        </svg>
                        <?php elseif ($exam->status == 2) : ?>
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M499.6 11.3c6.7-10.7 20.5-14.5 31.7-8.5s15.8 19.5 10.6 31L404.8 338.6c2.2 2.3 4.3 4.7 6.3 7.1l97.2-54.7c10.5-5.9 23.6-3.1 30.9 6.4s6.3 23-2.2 31.5l-87 87H378.5c-13.2-37.3-48.7-64-90.5-64s-77.4 26.7-90.5 64H117.8L42.3 363.7c-9.7-6.7-13.1-19.6-7.9-30.3s17.4-15.9 28.7-12.4l97.2 30.4c3-3.9 6.1-7.7 9.4-11.3L107.4 236.3c-6.1-10.1-3.9-23.1 5.1-30.7s22.2-7.5 31.1 .1L246 293.6c1.5-.4 3-.8 4.5-1.1l13.6-142.7c1.2-12.3 11.5-21.7 23.9-21.7s22.7 9.4 23.9 21.7l13.5 141.9L499.6 11.3zM64 448v0H512v0h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64zM288 0c13.3 0 24 10.7 24 24V72c0 13.3-10.7 24-24 24s-24-10.7-24-24V24c0-13.3 10.7-24 24-24z"></path>
                        </svg>
                        <?php elseif ($exam->status == 3) : ?>
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"></path>
                        </svg>
                        <?php elseif ($exam->status == 4) : ?>
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                        </svg>
                        <?php endif ?>

                    <td class="border px-4 py-2">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded" href="<?= site_url('AjoutExam/edit/' . $exam->id) ?>">
                            <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <script>
        const search = document.querySelector('#search');
        const semester = document.querySelector('#semester');
        const status = document.querySelector('#status');
        const mine = document.querySelector('#mine');

        search.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const td = row.querySelectorAll('td');
                let found = false;
                td.forEach(cell => {
                    const text = cell.innerText.toLowerCase();
                    if (text.indexOf(term) != -1)
                        found = true;
                });
                if (found)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });

        semester.addEventListener('change', function(e) {
            const term = e.target.value;
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const td = row.querySelectorAll('td');
                if (td[0].innerText.indexOf(term) != -1)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });

        status.addEventListener('change', function(e) {
            const term = e.target.value;
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const td = row.querySelectorAll('td');
                if (term == "" || row.attributes['x-data'].value == term)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });

        mine.addEventListener('change', function(e) {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const td = row.querySelectorAll('td');
                if (!e.target.checked || td[2].innerText.indexOf("<?= $user->first_name ?> <?= $user->last_name ?>") != -1)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });
    </script>

</main>

