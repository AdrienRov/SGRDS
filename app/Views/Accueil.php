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
<main class="flex-1">
 <div class="mx-5">
    <?php if ($user->type == 1) : ?>
        <div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
            <h1 class="text-2xl font-bold">Espace Directeur</h1>
            <a href="/DirectorDashboard" class="bg-orange hover:bg-orange-light text-white font-bold py-2 px-4 rounded">Dashboard</a>
        </div>

    <?php endif ?>

    <div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
        <h1 class="text-2xl font-bold">Exams</h1>
        <div>
            <a href="<?= site_url('AjoutExam') ?>" class="px-8  py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer">Ajouter un examen</a>
            <input type="text" name="search" id="search" placeholder="Rechercher" class="px-32 py-1" />
            <select name="semester" id="semester" class="px-32 py-1">
                <option value="">Tous les semestres</option>
                <?php foreach ($semesters as $semester) : ?>
                    <option value="<?= $semester->semester ?>"><?= $semester->semester ?></option>
                <?php endforeach ?>
            </select>

            <label for="mine">Mes exams</label>
            <input type="checkbox" name="mine" id="mine" class="px-32 py-1" />
        </div>
        <div class="mx-10">
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th class="px-4 py-2">Semestre</th>
                    <th class="px-4 py-2">Ressource</th>
                    <th class="px-4 py-2">Enseignant</th>
                    <th class="px-4 py-2">Date</th>
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

                        <td class="border px-4 py-2 flex">
                            <a class="" href="<?= site_url('AjoutRattrapage/' . $exam->id) ?>">
                                <svg class="rounded w-[40px] h-[40px] fill-[#5e5e5e] hover:fill-orange p-2" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path>
                                </svg>
                            </a>

                            <a class="" href="<?= site_url('AjoutExam/edit/' . $exam->id) ?>">
                                <svg class="rounded w-[40px] h-[40px] fill-[#5e5e5e] hover:fill-orange p-2" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

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
 </div>
</main>