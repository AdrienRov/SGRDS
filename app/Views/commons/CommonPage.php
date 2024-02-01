<?php
	$userIsLoggedIn = isset($_SESSION['user']);
    $currentPage = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SGRDS</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" /> -->
	<script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            light: '#da5e34',
                            DEFAULT: '#bb471e',
                            dark: '#8c2b08',
                        }
                    }
                }
            }
        }
    </script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="flex flex-col min-h-svh">
	<header class="text-white bg-orange pr-4 flex justify-between items-center">
		<div class="py-4 h-20 w-1/5 flex justify-center items-center bg-zinc-300 text-center" id="logo">
			<a href="<?= site_url('accueil') ?>" class="font-bold w-1/3">
				<img src="/assets/images/logo.png" alt="Logo" class="max-w-full max-h-full">
			</a>
		</div>

		<?php

            if ($userIsLoggedIn && $currentPage !== '/logout') {
                ?>
                <nav class="flex items-center" id="navbar">
                    <a href="<?= site_url('accueil') ?>" class="ml-4">Accueil</a>
                    <a href="<?= site_url('absences') ?>" class="ml-4">Absences</a>
                    <?php if (intval($_SESSION['user']->type) === 1) : ?>
                        <a href="<?= site_url('AjoutExam') ?>" data-page="AjoutExam" class="ml-4 page-link">Ajout d'examen</a>
                    <?php endif ?>
                    <a href="<?= site_url('rattrapages') ?>" data-page="rattrapages" class="ml-4 page-link">Rattrapages</a>
                    <a href="<?= site_url('UserProfile') ?>" data-page="UserProfile" class="ml-4 page-link">Mon profil</a>
                    <a href="<?= site_url('logout') ?>" data-page="logout" id="logoutBtn" class="ml-4 page-link">
					<svg class="w-1/2 h-[50px] fill-[white]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
						<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
					</svg>
                    </a>
                </nav>
                <?php
            }
        ?>
	</header>

	<div class="my-4">
		<?php
		helper('breadcrumbs');

		if (!empty($breadcrumbs)) {
			echo generate_breadcrumbs($breadcrumbs);
		}
		?>
	</div>

	<?= $content; ?>

	<footer class="bg-gray-800 text-white py-4">
		<div class="container mx-auto">
			<div class="flex justify-center">
				<p>&copy; 2024 IUT le Havre. Tous droits réservés.</p>
			</div>
		</div>
	</footer>
	<script src="./assets/js/commons/NavBar.js"></script>
	<script src="./assets/js/commons/Connexion.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>