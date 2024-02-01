<?php
function getStudentById($students, $id)
{
    foreach ($students as $student) {
        if ($student->id == $id) {
            return $student;
        }
    }
}


?>


<main>
	<h1 class="h1">Ajout d'un ratrappage</h1>
	
	<form action="<?= site_url('AjoutRattrapage/ajout') ?>" method="post" enctype="multipart/form-data">
		<div class="flex justify-center">
			<h1>Rattrapage de <?= $resource->name ?></h1>
			<div class="flex flex-col bg-slate-400 px-16 py-8 mt-8">
				<div class="flex flex-row">
					<div class="flex flex-col gap-1">

						<input type="hidden" name="original_id" id="original_id" value="<?= $exam->id ?>" />
						<input type="hidden" name="semester_id" id="semester_id" value="<?= $exam->semester_id ?>" />
						<input type="hidden" name="resource_id" id="resource_id" value="<?= $exam->resource_id ?>" />

						<input type="datetime-local" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d\TH:i:s', strtotime($exam->date)) ?>" class="px-32 py-1" />
						<input type="number" name="duration" id="time" placeholder="Minutes" class="px-32 py-1" value="<?= $exam->duration ?>" />
						<select name="type" id="type" class="px-32 py-1">
							<option value="0" <?= $exam->type == 0 ? 'selected' : '' ?>>Machine</option>
							<option value="1" <?= $exam->type == 1 ? 'selected' : '' ?>>Papier</option>
						</select>

						<input type="text" name="class" id="class" placeholder="Class" class="px-32 py-1" value="<?= $exam->class ?>" />
						<select name="status" id="status" class="px-32 py-1">
							<option value="0">Programmé</option>
							<option value="1">En cours</option>
							<option value="2">Neutralisé</option>
							<option value="3">Annulé</option>
							<option value="4">Passé</option>
						</select>

                        <select name="user_id" id="user_id" class="px-32 py-1">
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>"><?= $user->first_name ?> <?= $user->last_name ?></option>
                            <?php endforeach ?>
                        </select>

						<textarea type="text" name="comment" id="comment" placeholder="Commantaire" class="px-32 py-1">Ratrappage de l'examen du <?= $exam->date ?> de <?= $resource->name ?></textarea>

                        <!-- list all students participating to the exam with a select to choose who was present, absent or justified -->
                        <?php foreach ($participations as $participation) {
                            $studient = getStudentById($students, $participation->student_id);
                            ?>
                        <label for="participation_<?= $participation->id ?>"><?= $studient->first_name ?> <?= $studient->last_name ?></label>
                        <select name="participations[]" id="participation_<?= $participation->student_id ?>" class="px-32 py-1">
                            <option value="<?= $participation->student_id ?>-0">Absent</option>
                            <option value="<?= $participation->student_id ?>-1">Présent</option>
                            <option value="<?= $participation->student_id ?>-2">Justifié</option>
                        </select>
                        <?php } ?>




						<input type="submit" value="Ajouter" class="px-32 py-1 bg-orange-400" />
					</div>
				</div>
			</div>
		</div>
	</form>
</main>