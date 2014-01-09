<?php namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DownloadableReport;

class TopCustomers extends DownloadableReport
{

	protected $limit = 600;

	public function view($params = array())
	{
		// Immediately process the data into the file
		$this->process();

		// Return the file to download
		return $this->download();
	}

	public function getData($from = null, $limit = null)
	{
		$query = "SELECT *
			FROM order_item AS oi
			LEFT JOIN order_summary AS os ON (oi.order_id = os.order_id)
			GROUP BY os.user_id
			-- ORDER BY total_spend_GBP DESC
		";

		$params = array();

		return $this->_query->run($query, $params);
	}

	public function getName()
	{
		return "Top " . $this->limit . " Customers";
	}

	public function getDescription()
	{
		return "Top " . $this->limit . " customers by combined purchase amount";
	}

}