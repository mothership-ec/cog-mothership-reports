<?php namespace UniformWares\Reports\Controller\Report;

use Message\Cog\Controller\Controller;

class Dashboard extends Controller
{

	public function index()
	{
		return $this->redirectToRoute('ms.commerce.report.view', array(
			'slug' => 'daily-sales'
		));
	}

}