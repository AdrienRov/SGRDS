<main class="flex-1">
    <h1 class="text-3xl font-bold mx-3 my-3">Ajout d'examen</h1>

	<form action="<?= site_url('AjoutExam/ajout') ?>" method="post" enctype="multipart/form-data">
		<div class="flex justify-center">
			<div class="flex flex-col w-50 bg-zinc-300 rounded-lg px-16 py-8 mb-4">
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
			<div class="flex flex-col bg-zinc-300 rounded-lg px-16 py-8 mt-8">
				<div class="flex flex-row">
					<div class="flex flex-col gap-1">
						<input type="datetime-local" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d\TH:i:s') ?>" class="part2 px-32 py-1" required />
						<input type="number" name="duration" id="time" placeholder="Durée (en minutes)" class="part2 px-32 py-1" required />
						<select name="type" id="type" class="part2 px-32 py-1">
							<option value="0">Machine</option>
							<option value="1">Papier</option>
						</select>

						<input type="text" name="class" id="class" placeholder="Class" class="part2 px-32 py-1" required />
						<input type="hidden" name="status" id="status" value="-1" />

                        <select name="user_id" id="user_id" class="px-32 py-1">
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>"><?= $user->first_name ?> <?= $user->last_name ?></option>
                            <?php endforeach ?>
                        </select>

                        <!-- list students with checkbox to select, send as array of id in post -->
						<div class="border border-gray-400 rounded-lg p-4 flex flex-col gap-1">
                            <h1 class="text-xl font-bold">Etudiants</h1>
							<select id="promotion" class="px-32 py-1">
								<option value="0">Toutes les promotions</option>
								<?php
								$promotions = array_unique(array_map(function ($student) {
									return $student->promotion;
								}, $students));
								?>
								<?php foreach ($promotions as $promotion) : ?>
									<option value="<?= $promotion ?>"><?= $promotion ?></option>
								<?php endforeach ?>
							</select>
							<span>
								<input type="checkbox" id="select_all_students" />
								<label for="select_all_students">Tous les étudiants</label>
							</span>
							<?php foreach ($students as $student) : ?>
							<span x-data="<?= $student->promotion ?>" class="student">
								<input type="checkbox" name="students[]" id="student_<?= $student->id ?>" value="<?= $student->id ?>" class="student_input" />
								<label for="student_<?= $student->id ?>"><?= $student->first_name ?> <?= $student->last_name ?></label>
							</span>
							<?php endforeach ?>
						</div>
						
						<textarea type="text" name="comment" id="comment" placeholder="Commantaire" class="px-32 py-1"></textarea>

						<p class="text-red-400" id="no_student_selected">Aucun étudiant n'est sélectionné</p>
						<input type="submit" value="Ajouter" class="part2 px-32 py-1 text-white bg-orange-light hover:bg-white hover:text-black cursor-pointer" />
					</div>
				</div>
			</div>
		</div>
	</form>

	<script>
        // Disable submit button if no student is selected
        let students = document.querySelectorAll('.student');
        // bind all checkboxes to the same function
        const updateSubmitButton = () => {
            let checked = false;
            students.forEach(student => {
				console.log(student.querySelector('.student_input').checked);
                if (student.querySelector('.student_input').checked) {
					checked = true;
					console.log('checked');
				}
            });
            if (checked) {
                document.querySelector('input[type="submit"]').disabled = false;
                document.querySelector('#no_student_selected').classList.add('hidden');
            } else {
                document.querySelector('input[type="submit"]').disabled = true;
                document.querySelector('#no_student_selected').classList.remove('hidden');
            }
        }

        students.forEach(student => {
            student.querySelector('input').addEventListener('change', updateSubmitButton);
        });

        updateSubmitButton();

		$('#select_all_students').on('change', () => {
			let checked = $('#select_all_students').prop('checked');
			let promotion = $('#promotion').val();
			let students = document.querySelectorAll('.student');
			students.forEach(student => {
				if (student.getAttribute('x-data') != promotion && promotion != 0)
					return;
				if (checked) {
					student.querySelector('input').checked = true;
				} else {
					student.querySelector('input').checked = false;
				}
			});
			updateSubmitButton();
		});
		
		$('#promotion').on('change', () => {
			let promotion = $('#promotion').val();
			let students = document.querySelectorAll('.student');
			let all_checked = true;

			students.forEach(student => {
				if (student.getAttribute('x-data') == promotion || promotion == 0) {
					student.style.display = 'block';
					if (!student.querySelector('input').checked) {
						all_checked = false;
					}
				} else {
					student.style.display = 'none';
				}
			});

			if (all_checked) {
				$('#select_all_students').prop('checked', true);
			} else {
				$('#select_all_students').prop('checked', false);
			}

		})

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