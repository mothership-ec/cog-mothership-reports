<?php namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\ReportType\DateRangeReport;

class SearchTermsDetail extends DateRangeReport {

	public function getForm()
	{
		$form = parent::getForm();

		$formData = $this->_controller->get('request')->get('form');

		$value = null;
		$value = ($this->_controller->get('request')->get('term')) ?: $value;
		$value = (isset($formData['term'])) ? $formData['term'] : $value;

		$form->add('term', 'text', 'Term', array(
			'data' => $value
		));

		return $form;
	}

	public function getColumns()
	{
		return array(
			'created_by' => 'User',
			'created_at_time' => 'Date / Time',
			'referrer' => 'Referrer',
			'ip_address' => 'IP Address',
		);
	}

	public function formatColumn($column, $value)
	{
		if ($column == 'created_by') {
			if (! $value or empty($value)) {
				return '<em>not logged in</em>';
			}
		}

		return $value;
	}

	public function getData($from = null, $limit = null)
	{
		$query = '
			SELECT
				*,
				FROM_UNIXTIME(created_at) as created_at_time
			FROM
				search_log
			WHERE
				term = ?s
			ORDER BY
				created_at DESC
		';

		$form = $this->getForm()->getFilteredData();

		// Get the data in the date range, default to last 28 days.
		$date_range = $this->getDateRange($form, 28);
		$params = array(
			($form['term']) ?: $this->_controller->get('request')->get('term')
		);

		$rows = $this->_query->run($query, $params);

		$data = array();
		foreach ($rows as $key => $row) {
			$data[] = $row;
		}

		// Save this data for use in other methods
		$this->data = $data;

		return $data;
	}

	public function getStartDate()
	{
		$first = $this->_query->run('SELECT FROM_UNIXTIME(created_at) as created_at_time FROM search_log ORDER BY created_at ASC LIMIT 1');

		if (0 === count($first)) {
			return '1970-01-01';
		}

		return date('Y-m-01', strtotime($first[0]->created_at_time));
	}

	public function getName()
	{
		return "Search Term Details";
	}

	public function getDescription()
	{
		return 'Search term logs - ' . $this->_controller->get('request')->get('term');
	}

}