<?php

namespace Message\Mothership\Report\Controller\Report;

use Message\Cog\Controller\Controller;

class Sidebar extends Controller
{
	public function index($selected = null)
	{
		$reports = $this->get('report.reports');

		return $this->render('Message:Mothership:Report::report:sidebar', array(
			'reports'  => $reports,
			'selected' => $selected,
		));
	}
}