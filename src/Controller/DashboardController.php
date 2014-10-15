<?php 

namespace Message\Mothership\Report\Controller;

use Message\Cog\Controller\Controller as BaseController;

class DashboardController extends BaseController
{
	public function index()
	{
		$reports = $this->get('report.collection');

		return $this->render('Message:Mothership:Report::dashboard', [
				'reports' => $reports,
			]);
	}
}