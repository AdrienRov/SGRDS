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

    <?php if ($user->type == 1) : ?>
        <h1 class="text-3xl font-bold mx-3 my-3">Esapce Directeur</h1>
        <a href="/DirectorDashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dashboard</a>
    <?php endif ?>


    <h1 class="text-3xl font-bold mx-3 my-3">Exams</h1>
    <div>
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

                    <td class="border px-4 py-2">
                        <a class="" href="<?= site_url('AjoutRattrapage/' . $exam->id) ?>">
                            <svg class="bg-blue-500 hover:bg-blue-700 rounded w-[40px] h-[40px] fill-[#5e5e5e] p-2" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
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

</main>