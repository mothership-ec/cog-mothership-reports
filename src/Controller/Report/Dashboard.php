<?php

namespace Message\Mothership\Report\Controller\Report;

use Message\Cog\Controller\Controller;

class Dashboard extends Controller
{
	public function index()
	{
		return $this->redirectToRoute('ms.report.view', array(
			'slug' => 'daily-sales'
		));
	}
}