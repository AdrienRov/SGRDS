<?php

function getStudentById($students, $id)
{
    foreach ($students as $student) {
        if ($student->id == $id) {
            return $student;
        }
    }
    return null;
}

?>


<main class="flex-1">
    <h1 class="text-3xl font-bold mx-3 my-3">Modification d'examen</h1>

    <form action="<?= site_url('AjoutExam/edit/' . $exam->id) ?>" method="post" enctype="multipart/form-data">
        <div class="flex justify-center">
            <div class="flex flex-col w-50 bg-zinc-300 rounded-lg px-16 py-8 mb-4">
                <div class="flex flex-row">
                    <div class="flex flex-col gap-1">
                        <select name="semester_id" id="semester_id" class="px-32 py-1">
                            <option value="0">Aucun</option>
                            <?php foreach ($semesters as $semester) : ?>
                                <option value="<?= $semester->id ?>" <?= $semester->id == $exam->semester_id ? 'selected' : '' ?>
                                ><?= $semester->annee ?> - <?= $semester->semester ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="resource_id" id="resource_id" class="px-32 py-1">
                            <option value="0">Aucun</option>
                            <?php foreach ($resources as $resource) : ?>
                                <option value="<?= $resource->id ?>" <?= $resource->id == $exam->resource_id ? 'selected' : '' ?>
                                ><?= $resource->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center part2">
            <div class="flex flex-col bg-zinc-300 rounded-lg px-16 py-8 mt-8">
                <div class="flex flex-row">
                    <div class="flex flex-col gap-1">
                        <input type="text" name="comment" id="comment" placeholder="Commantaire" class="part2 px-32 py-1" value="<?= $exam->comment ?>" />
                        <input type="datetime-local" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d\TH:i:s', strtotime($exam->date)) ?>" class="part2 px-32 py-1" />
                        <input type="number" name="duration" id="time" placeholder="Minutes" class="part2 px-32 py-1" value="<?= $exam->duration ?>" />
                        <select name="type" id="type" class="part2 px-32 py-1">
                            <option value="0" <?= $exam->type == 0 ? 'selected' : '' ?>>Machine</option>
                            <option value="1" <?= $exam->type == 1 ? 'selected' : '' ?>>Papier</option>
                        </select>

                        
                        <select name="user_id" id="user_id" class="px-32 py-1">
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>" <?= $user->id == $exam->user_id ? 'selected' : '' ?>><?= $user->first_name ?> <?= $user->last_name ?></option>
                            <?php endforeach ?>
                        </select>

                        <input type="text" name="class" id="class" placeholder="Class" class="part2 px-32 py-1" value="<?= $exam->class ?>" />
                        <select name="status" id="status" class="part2 px-32 py-1">
                            <option value="0" <?= $exam->status == 0 ? 'selected' : '' ?>>Programmé</option>
                            <option value="1" <?= $exam->status == 1 ? 'selected' : '' ?>>En cours</option>
                            <option value="2" <?= $exam->status == 2 ? 'selected' : '' ?>>Neutralisé</option>
                            <option value="3" <?= $exam->status == 3 ? 'selected' : '' ?>>Annulé</option>
                            <option value="4" <?= $exam->status == 4 ? 'selected' : '' ?>>Passé</option>
                            <option value="100" <?= $exam->status == 100 ? 'selected' : '' ?>>Supprimé</option>
                        </select>

                        <!-- list students with checkbox to select, send as array of id in post -->
                        <?php foreach ($participations as $participation) {
                            $studient = getStudentById($students, $participation->student_id);
                            ?>
                            <span>
                                <label for="student_<?= $participation->student_id ?>"><?= $studient->first_name ?> <?= $studient->last_name ?></label>
                                <select name="participations[]" id="participation_<?= $participation->id ?>" class="px-32 py-1">
                                    <option value="<?= $participation->id ?>-0" <?= $participation->status == 0 ? 'selected' : '' ?>>Absent</option>
                                    <option value="<?= $participation->id ?>-1" <?= $participation->status == 1 ? 'selected' : '' ?>>Présent</option>
                                    <option value="<?= $participation->id ?>-2" <?= $participation->status == 2 ? 'selected' : '' ?>>Justifié</option>
                                    <option value="<?= $participation->id ?>-100" <?= $participation->status == 3 ? 'selected' : '' ?>>Supprimer</option>
                                </select>
                            </span>
                        <?php } ?>



                        <input type="submit" value="Modifier" class="part2 px-32 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>

    </script>
</main>