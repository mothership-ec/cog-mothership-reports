<?php 

namespace Message\Mothership\Report\Controller;

use Message\Cog\Controller\Controller as BaseController;

class DashboardController extends BaseController
{
	public function index()
	{
		$reports = $this->get('report.collection');

		de($reports);
	}
}