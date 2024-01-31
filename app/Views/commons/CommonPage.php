<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SGRDS</title>
	<link rel="stylesheet" href="/assets/css/commons/commonPage.css">
	<!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" /> -->
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
	<header class="text-white pr-4 flex justify-between items-center">
		<!-- Logo à gauche -->
		<div class="py-4 h-20 w-1/5 flex justify-center items-center" id="logo">
			<!-- Logo IUT le havre-->
			<a href="#" data-page="accueil" class="font-bold page-link w-1/3">
				<img src="/assets/images/logo.png" alt="Logo">
			</a>
		</div>

		<!-- Onglets à droite -->
		<nav class="">
			<a href="#" data-page="absences" class="ml-4 page-link">Absences</a>
			<a href="#" data-page="rattrapages" class="ml-4 page-link">Rattrapages</a>
		</nav>
	</header>

	<?= $content; ?>

	<footer class="bg-gray-800 text-white py-4">
		<div class="container mx-auto">
			<div class="flex justify-center">
				<p>&copy; 2024 IUT le Havre. Tous droits réservés.</p>
			</div>
		</div>
	</footer>
	<script src="./assets/js/commons/NavBar.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>