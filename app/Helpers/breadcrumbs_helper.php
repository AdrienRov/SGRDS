<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generate_breadcrumbs')) {
	function generate_breadcrumbs($breadcrumbs_array)
	{
		$breadcrumbs = '<nav class="flex text-xl ml-4" aria-label="Breadcrumb"><ol class="inline-flex items-center">';
		$count = count($breadcrumbs_array); // Obtenez le nombre total d'éléments dans le tableau
		$index = 1; // Initialisez un compteur pour suivre l'index actuel

		foreach ($breadcrumbs_array as $breadcrumb) {
			$breadcrumbs .= '<li>';
			if ($breadcrumb['link']) {
				$breadcrumbs .= '<a href="' . site_url($breadcrumb['link']) . '" class="items-center font-medium text-gray-700 hover:text-orange-600">' . $breadcrumb['title'] . '</a>';
			}

			// Vérifiez si l'élément actuel n'est pas le dernier
			if ($index < $count) {
				$breadcrumbs .= '<span class="text-orange-600"> &nbsp;->&nbsp;</span>'; // Ajoutez le séparateur seulement si ce n'est pas le dernier élément
			}
			
			$breadcrumbs .= '</li>';

			$index++; // Incrémentez le compteur d'index
		}

		$breadcrumbs .= '</ol></nav>';
		return $breadcrumbs;
	}
}

if (!function_exists('getBreadcrumbs')) {
	function getBreadcrumbs($titles, $links)
	{
		$breadcrumbs = [];
		for ($i = 0; $i < count($titles); $i++) {
			$breadcrumb = [
				'title' => $titles[$i],
				'link' => $links[$i]
			];
			$breadcrumbs[] = $breadcrumb;
		}
		return $breadcrumbs;
	}
}
