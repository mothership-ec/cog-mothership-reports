<?php

namespace Message\Mothership\Report\Controller\Report;

use Message\Cog\Controller\Controller;

class View extends Controller
{
	public function index($slug)
	{
		$reports = $this->get('report.reports');

		if (!array_key_exists($slug, $reports)) {
			throw $this->createNotFoundException('Report not found');
		}

		return $reports[$slug]->index($this);
	}
}