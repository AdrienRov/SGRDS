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


<main class="flex-1">
    <h1 class="text-3xl font-bold mx-3 my-3">Ajouter un rattrapage</h1>
	
	<form action="<?= site_url('AjoutRattrapage/ajout') ?>" method="post" enctype="multipart/form-data">
		<div class="flex justify-center">
			<div class="flex flex-col bg-zinc-300 rounded-lg px-16 py-8 mt-8">
                <h1 class="text-xl font-bold">Rattrapage de <?= $resource->name ?></h1>
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

                        <!-- make group box (border) -->
                        
                        <div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
                            <h1 class="text-xl font-bold">Etudiants</h1>

                            <?php
                            $absents = array_filter($participations, function ($participation) {
                                return $participation->status != 1;
                            });
                            if (count($absents) == 0) { ?>
                                <span class="text-red-400">Aucun étudiant n'est absent</span>
                                <a href="<?= site_url('AjoutExam/edit/' . $exam->id) ?>" class="px-32 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer">Modifier l'examen</a>
                            <?php } else {
                                foreach ($absents as $participation) {
    
                                $student = getStudentById($students, $participation->student_id);
                                ?>
                                    <span>
                                        <label for="participation_<?= $participation->id ?>">
                                            <?= $student->first_name ?> <?= $student->last_name ?>
                                            <?php if ($participation->status == 0) : ?>
                                                <span class="text-gray-400">Absent</span>
                                            <?php elseif ($participation->status == 1) : ?>
                                                <span class="text-green-400">Présent</span>
                                            <?php elseif ($participation->status == 2) : ?>
                                                <span class="text-yellow-400">Justifié</span>
                                            <?php endif ?>
                                        </label>
                                        <input type="checkbox" name="participations[]" id="participation_<?= $student->id ?>" value="<?= $student->id ?>" <?= $participation->status == 2 ? 'checked' : '' ?> />
                                    </span>
                            <?php }
                            } ?>

                        </div>
                        
						<input type="submit" value="Ajouter" class="px-32 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
					</div>
				</div>
			</div>
		</div>
	</form>
</main>