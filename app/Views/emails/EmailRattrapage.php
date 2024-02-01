<html>
    <body>
        <h1>Rattrapage de <?= $resource->name ?> le <?= $exam->date ?></h1>
        <p>Vous avez un rattrapage pour l'examen <?= $resource->name ?> le <?= $exam->date ?> (pendant <?= $exam->duration ?> minutes) dans la classe <?= $exam->class ?></p>

        <?php if (!empty($exam->comment)): ?>
            <p>Commentaire du professeur :</p>
            <pre>
                <?= $exam->comment ?>
            </pre>
        <?php endif; ?>

    </body>
</html>