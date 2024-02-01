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

function getExamById($exams, $id)
{
    foreach ($exams as $exam) {
        if ($exam->id == $id) {
            return $exam;
        }
    }
}

function getStudentById($students, $id)
{
    foreach ($students as $student) {
        if ($student->id == $id) {
            return $student;
        }
    }
}
?>


<main class="flex-1">
    <h1 class="text-3xl font-bold mx-3 my-3">Absences</h1>

    <div>
        <input type="text" name="search" id="search" placeholder="Rechercher" class="px-32 py-1" />
        <select name="semester" id="semester" class="px-32 py-1">
            <option value="">Tous les semestres</option>
            <?php foreach ($semesters as $semester) : ?>
                <option value="<?= $semester->semester ?>"><?= $semester->semester ?></option>
            <?php endforeach ?>
        </select>

        <select name="status" id="status" class="px-32 py-1">
            <option value="">Toutes les présences</option>
            <option value="0">Absents</option>
            <option value="1">Présents</option>
            <option value="2">Justifiés</option>
        </select>

        <label for="mine">Mes absences</label>
        <input type="checkbox" name="mine" id="mine" class="px-32 py-1" />
    </div>
    <div class="mx-10">
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">Semestre</th>
            <th class="px-4 py-2">Ressource</th>
            <th class="px-4 py-2">Etudiant</th>
            <th class="px-4 py-2">Promotion</th>
            <th class="px-4 py-2">Présence</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($participations as $participation) :
            $exam = getExamById($exams, $participation->exam_id);
            $student = getStudentById($students, $participation->student_id);
            ?>
            <tr x-data="<?= $exam->user_id ?>:<?= $participation->status ?>">
                <td class="border px-4 py-2">S<?= getSemesterById($semesters, $exam->semester_id)->semester ?></td>
                <td class="border px-4 py-2"><?= getResourceById($resources, $exam->resource_id)->name ?></td>
                <td class="border px-4 py-2"><?= $student->first_name ?> <?= $student->last_name ?></td>
                <td class="border px-4 py-2"><?= $student->promotion ?></td>
                <td class="border px-4 py-2">
                    <?php if ($participation->status == 0) {
                        echo "Absent";
                    } elseif ($participation->status == 1) {
                        echo "Présent";
                    } elseif ($participation->status == 2) {
                        echo "Justifié";
                    } ?>
                </td>
                <td class="border px-4 py-2"><?= $exam->date ?></td>

                <td class="border px-4 py-2">
                    <a href="<?= site_url('AjoutExam/edit/' . $exam->id) ?>">
                        <svg class="w-[30px] h-[30px] fill-[#8e8e8e]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"></path>
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
                let status = row.attributes['x-data'].value.split(':')[1];
                if (term == "" || status == term)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });

        mine.addEventListener('change', function(e) {
            const term = e.target.checked;
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const td = row.querySelectorAll('td');
                let user_id = row.attributes['x-data'].value.split(':')[0];
                if (term == false || user_id == <?= $user->id ?>)
                    row.style.display = '';
                else
                    row.style.display = 'none';
            });
        });

    </script>

</main>

