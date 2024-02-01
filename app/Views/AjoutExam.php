<main>
	<h1 class="h1">Ajout d'examen</h1>

	<form action="<?= site_url('AjoutExam/ajout') ?>" method="post" enctype="multipart/form-data">
		<div class="flex justify-center">
			<div class="flex flex-col w-50 bg-slate-400 px-16 py-8 mb-4">
				<div class="flex flex-row">
					<div class="flex flex-col gap-1">
						<select name="semester_id" id="semester_id" class="px-32 py-1">
							<option value="0">Aucun</option>
							<?php foreach ($semesters as $semester) : ?>
								<option value="<?= $semester->id ?>"><?= $semester->annee ?> - <?= $semester->semester ?></option>
							<?php endforeach; ?>
						</select>

						<select name="resource_id" id="resource_id" class="px-32 py-1">
							<option value="0">Aucun</option>
							<?php foreach ($resources as $resource) : ?>
								<option value="<?= $resource->id ?>"><?= $resource->name ?></option>
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
						<input type="text" name="comment" id="comment" placeholder="Commantaire" class="part2 px-32 py-1" />
						<input type="datetime-local" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d\TH:i:s') ?>" class="part2 px-32 py-1" />
						<input type="number" name="duration" id="time" placeholder="Minutes" class="part2 px-32 py-1" />
						<select name="type" id="type" class="part2 px-32 py-1">
							<option value="0">Machine</option>
							<option value="1">Papier</option>
						</select>

						<input type="text" name="class" id="class" placeholder="Class" class="part2 px-32 py-1" />
						<input type="hidden" name="status" id="status" value="-1" />

                        <!-- list students with checkbox to select, send as array of id in post -->
                        <?php foreach ($students as $student) : ?>
                        <span>
                            <input type="checkbox" name="students[]" id="student_<?= $student->id ?>" value="<?= $student->id ?>" />
                            <label for="student_<?= $student->id ?>"><?= $student->first_name ?> <?= $student->last_name ?></label>
                        </span>
                        <?php endforeach ?>


						<input type="submit" value="Ajouter" class="part2 px-32 py-1 bg-orange-400" />
					</div>
				</div>
			</div>
		</div>
	</form>

	<script>

		$('.part2').hide();
		$('#semester_id, #resource_id').on('change', () => {
			if ($('#semester_id').val() != 0 && $('#resource_id').val() != 0) {
				$('.part2').show();
			} else {
				$('.part2').hide();
			}
		});
	</script>
</main>