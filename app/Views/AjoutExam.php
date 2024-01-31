<h1 class="h1">Ajout d'examen</h1>

<form
    action="<?= site_url('AjoutExam/ajout') ?>"
    method="post"
    enctype="multipart/form-data"
>
    <select name="semester_id" id="semester_id">
        <?php foreach ($semesters as $semester) : ?>
            <option value="<?= $semester->id ?>"><?= $semester->annee ?> - <?= $semester->semester ?></option>
        <?php endforeach; ?>
    </select>

    <select name="resource_id" id="resource_id">
        <?php foreach ($resources as $resource) : ?>
            <option value="<?= $resource->id ?>"><?= $resource->name ?></option>
        <?php endforeach; ?>
    </select>

    <select name="origin_id" id="origin_id">
        <option value="0">Aucun</option>
    </select>

    <input type="text" name="comment" id="comment" placeholder="Commantaire" />
    <input type="date" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d') ?>" />
    <input type="number" name="duration" id="time" placeholder="Minutes" />
    <select name="type" id="type">
        <option value="0">Machine</option>
        <option value="1">Papier</option>
    </select>

    <input type="text" name="class" id="class" placeholder="Class" />
    <select name="status" id="status">
        <option value="0">Programmé</option>
        <option value="1">En cours</option>
        <option value="2">Neutralisé</option>
        <option value="3">Annulé</option>
        <option value="4">Passé</option>
    </select>

    <input type="submit" value="Ajouter" />
</form>


<script>
    const exams = <?= json_encode($exams) ?>;

    const filterExams = () => {
        const semester_id = $('#semester_id').val();
        const resource_id = $('#resource_id').val();
        const filteredExams = exams.filter(exam => exam.semester_id == semester_id && exam.resource_id == resource_id);
        $('#origin_id').html('<option value="0">Aucun</option>');
        filteredExams.forEach(exam => {
            $('#origin_id').append(`<option value="${exam.id}">${exam.comment}</option>`);
        });
    }

    // filtrer les exams au chargement de la page
    $('#semester_id, #resource_id').on('change', filterExams);
    filterExams();

    // quand on selectionne un original, mettre commentaire a "Ratrapage [MATIERE] [DATE]"
    $('#origin_id').on('change', () => {
        const origin_id = $('#origin_id').val();
        const exam = exams.find(exam => exam.id == origin_id);
        $('#comment').val(`Ratrapage ${exam.comment} ${exam.date}`);
        $('#type').val(exam.type);
        $('#time').val(exam.duration);
        $('#class').val(exam.class);
    });

</script>