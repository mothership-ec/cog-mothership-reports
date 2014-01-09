<?php namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DownloadableReport;

class MailSubscribers extends DownloadableReport
{

	public function getData($from = null, $limit = null)
	{

	}

	public function getName()
	{
		return "Mail Subscribers";
	}

	public function getDescription()
	{
		return "All customers who are opted in (email updates) GB only";
	}

}