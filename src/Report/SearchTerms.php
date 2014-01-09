<?php

namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DateRangeReport;

class SearchTerms extends DateRangeReport
{
	public function getColumns()
	{
		return array(
			'term' => 'Term',
			'frequency' => 'Frequency'
		);
	}

	public function formatColumn($column, $value)
	{
		return $value;
	}

	public function getData($from = null, $limit = null)
	{
		$query = '
			SELECT
				term,
				COUNT(log_id) AS frequency
			FROM
				search_log
			WHERE
				created_at >= ? AND created_at <= ?
			GROUP BY
				term
			ORDER BY
				frequency DESC
		';

		$form = $this->getForm()->getFilteredData();

		// Get the data in the date range, default to last 28 days.
		$date_range = $this->getDateRange($form, 28);
		$params = array(
			$date_range[0]->getTimestamp(),
			$date_range[1]->getTimestamp()
		);

		$rows = $this->_query->run($query, $params);

		$data = array();
		$maxFreq = 0;
		foreach ($rows as $key => $row) {
			$maxFreq = ($row->frequency > $maxFreq) ? $row->frequency : $maxFreq;
		}

		foreach ($rows as $key => $row) {
			$row->percentage = 100 * $row->frequency / $maxFreq;
			$data[] = $row;
		}

		// Save this data for use in other methods
		$this->data = $data;

		return $data;
	}

	public function getStartDate()
	{
		$first = $this->_query->run('SELECT FROM_UNIXTIME(created_at) as created_at_time FROM search_log ORDER BY created_at ASC LIMIT 1');

		return date('Y-m-01', strtotime($first[0]->created_at_time));
	}

	public function getName()
	{
		return "Search Terms";
	}

	public function getDescription()
	{
		return 'Search term logs';
	}

	public function getView()
	{
		return '::report:searchterms';
	}
}