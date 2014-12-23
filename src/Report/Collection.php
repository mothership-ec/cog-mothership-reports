<?php

namespace Message\Mothership\Report\Report;

use Message\Cog\ValueObject\Collection as BaseCollection;

class Collection extends BaseCollection
{
	protected function _configure()
	{
		$this->setKey(function($report) {
			return $report->getName();
		});

		$this->setType('Message\\Mothership\\Report\\Report\\ReportInterface');
	}
}