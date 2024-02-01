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


<main>
    <h1 class="h1">Ajout d'examen</h1>

    <form action="<?= site_url('AjoutExam/edit/' . $exam->id) ?>" method="post" enctype="multipart/form-data">
        <div class="flex justify-center">
            <div class="flex flex-col w-50 bg-slate-400 px-16 py-8 mb-4">
                <div class="flex flex-row">
                    <div class="flex flex-col gap-1">
                        <select name="semester_id" id="semester_id" class="px-32 py-1">
                            <option value="0">Aucun</option>
                            <?php foreach ($semesters as $semester) : ?>
                                <option value="<?= $semester->id ?>" <?= $semester->id == $exam->semester_id ? 'selected' : '' ?>
                                ><?= $semester->annee ?> - <?= $semester->semester ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="resource_id" id="resource_id" class="px-32 py-1" disabled>
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
            <div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
                <div class="flex flex-row">
                    <div class="flex flex-col gap-1">
                        <input type="text" name="comment" id="comment" placeholder="Commantaire" class="part2 px-32 py-1" value="<?= $exam->comment ?>" />
                        <input type="datetime-local" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d\TH:i:s', strtotime($exam->date)) ?>" class="part2 px-32 py-1" />
                        <input type="number" name="duration" id="time" placeholder="Minutes" class="part2 px-32 py-1" value="<?= $exam->duration ?>" />
                        <select name="type" id="type" class="part2 px-32 py-1">
                            <option value="0" <?= $exam->type == 0 ? 'selected' : '' ?>>Machine</option>
                            <option value="1" <?= $exam->type == 1 ? 'selected' : '' ?>>Papier</option>
                        </select>

                        <input type="text" name="class" id="class" placeholder="Class" class="part2 px-32 py-1" value="<?= $exam->class ?>" />
                        <select name="status" id="status" class="part2 px-32 py-1">
                            <option value="0" <?= $exam->status == 0 ? 'selected' : '' ?>>Programmé</option>
                            <option value="1" <?= $exam->status == 1 ? 'selected' : '' ?>>En cours</option>
                            <option value="2" <?= $exam->status == 2 ? 'selected' : '' ?>>Neutralisé</option>
                            <option value="3" <?= $exam->status == 3 ? 'selected' : '' ?>>Annulé</option>
                            <option value="4" <?= $exam->status == 4 ? 'selected' : '' ?>>Passé</option>
                        </select>

                        <!-- list students with checkbox to select, send as array of id in post -->
                        <?php foreach ($participations as $participation) {
                            $studient = getStudentById($students, $participation->student_id);
                            ?>
                            <span>
                                <label for="student_<?= $participation->student_id ?>"><?= $studient->first_name ?> <?= $studient->last_name ?></label>
                                <select name="participations[]" id="participation_<?= $participation->student_id ?>" class="px-32 py-1">
                                    <option value="<?= $participation->student_id ?>-0" <?= $participation->status == 0 ? 'selected' : '' ?>>Absent</option>
                                    <option value="<?= $participation->student_id ?>-1" <?= $participation->status == 1 ? 'selected' : '' ?>>Présent</option>
                                    <option value="<?= $participation->student_id ?>-2" <?= $participation->status == 2 ? 'selected' : '' ?>>Justifié</option>
                                </select>
                            </span>
                        <?php } ?>


                        <input type="submit" value="Modifier" class="part2 px-32 py-1 bg-orange-400" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        /*
        $('.part2').hide();
        $('#semester_id, #resource_id').on('change', () => {
            if ($('#semester_id').val() != 0 && $('#resource_id').val() != 0) {
                $('.part2').show();
            } else {
                $('.part2').hide();
            }
        });

         */
    </script>
</main>