<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generate_breadcrumbs')) {
    function generate_breadcrumbs($breadcrumbs_array) {
        $breadcrumbs = '';
        foreach ($breadcrumbs_array as $breadcrumb) {
            if ($breadcrumb['link']) {
                $breadcrumbs .= '<a href="' . site_url($breadcrumb['link']) . '">' . $breadcrumb['title'] . '</a> > ';
            } else {
                $breadcrumbs .= $breadcrumb['title'] . ' > ';
            }
        }
        // Remove the last separator
        $breadcrumbs = substr($breadcrumbs, 0, -3);
        return $breadcrumbs;
    }
}

if (!function_exists('getBreadcrumbs')) {
	function getBreadcrumbs($titles, $links) {
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