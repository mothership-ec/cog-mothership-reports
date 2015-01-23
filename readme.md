# Mothership Reports

The `Message\Mothership\Report` cogule provides a framework for providing reports in a new tab in the control panel.


## Creating a new report


### Registering reports

Register your reports in the Service container of the module it's in. This is an example of code in MS-User:

```
public function registerReports($services)
{
	$services['user.user_summary'] = $services->factory(function($c) {
		return new User\Report\UserSummary(
			$c['db.query.builder.factory'],
			$c['routing.generator']
		);
	});

	$services['user.reports'] = function($c) {
		$reports = new ReportCollection;
		$reports
			->add($c['user.user_summary'])
		;
			return $reports;
	};
}
```

### Creating reports

Create a folder `Reports` within `Src` if there isn't already one. All reports for this module will be saved in here.

##### Initial set up

All reports must extend `AbstractReport` and will use:

- `Message\Cog\DB\QueryBuilderInterface;`
- `Message\Cog\DB\QueryBuilderFactory;`
- `Message\Cog\Routing\UrlGenerator;`

##### Constructor

Set the:
- name: Used as an identifier and for naming the download file.
- displayName: Used on the front-end.
- description: Used on the front-end.
- reportGroup: Used to group similar reports on the dashboard.


Set all the filters and charts you want to use in the report.


Set any default filters you want for the report when it's first viewed.

This report displays `TableChart`, and uses filters `DateRange` and `Choices`. It sets the form default `StartDate` for 1 month ago.


```
		parent::__construct($builderFactory, $routingGenerator);
		$this->_setName('payments_refunds');
		$this->_setDisplayName('Payments & Refunds');
		$this->_setReportGroup('Transactions');
		$this->_setDescription('
			This report displays all payments & refunds.
			By default it includes all data from the last month (by completed date).
		');
		$this->_charts[]   = new TableChart;
		$this->_filters->add(new DateRange);
		$startDate = new \DateTime;
		$this->getFilters()
			->get('date_range')
			->setStartDate($startDate->setTimestamp(strtotime(date('Y-m-d H:i')." -1 month")));
		// Params for Choices filter: unique filter name, label, choices, multi-choice
		$this->_filters->add(new Choices(
			"type",
			"Type",
			[
				'payment' => 'Payment',
				'refund' => 'Refund',
			],
			false
		));
	}
```

##### getCharts()

All reports need this function:

```
public function getCharts()
{
	$data = $this->_dataTransform($this->_getQuery()->run(), "json");
	$columns = $this->_parseColumns($this->getColumns());
		foreach ($this->_charts as $chart) {
		$chart->setColumns($columns);
		$chart->setData($data);
	}
	return $this->_charts;
}
```

##### getColumns()

Set all the columns needed into an array with the key as the name and value as type of data that's expected. This type is used for Google Charts.

```
public function getColumns()
{
	return [
		'Date'         => 'string',
		'Created by'   => 'string',
		'Currency'     => 'string',
		'Method'       => 'string',
		'Amount'       => 'number',
		'Type'         => 'string',
		'Order/Return' => 'string',
	];
}
```

##### _getQuery()

Using QueryBuilder create your report query. A simple example is the User Summary report:

```
protected function _getQuery()
{
	$queryBuilder = $this->_builderFactory->getQueryBuilder();
		$queryBuilder
		->select('user.user_id AS "ID"')
		->select('created_at AS "Created"')
		->select('CONCAT(surname,", ",forename) AS "User"')
		->select('email AS "Email"')
		->from('user')
		->orderBy('surname')
	;

	return $queryBuilder->getQuery();
}
```

#### _dataTransform()

This takes the data from the query and converts it into either a string in JSON format for use in Google Charts, or a simple array for the CSV download.

For more complicated data you might need to pass in some optional properties.
See: https://developers.google.com/chart/interactive/docs/reference#cell_object

For example, to order dates in their numerical representation rather than alphabetically you will need to send the timestamp as a *value* but the string as *formatted value*.

```
[
	'v' => $row->Created,
	'f' => date('Y-m-d H:i', $row->Created)
],
```

Another example is for currency values:

```
[
	'v' => (float) $row->Gross,
	'f' => (string) number_format($row->Gross,2,'.',',')
],
```

For links, if you send just the html link as the *value* it will order the values using the full html rather than the display text. This is fine if the text is the same values used to create the URL, but in most cases the ID isn't what will be displayed. In this case, the user's name is sent as the *value* and the html (using the user-id) is sent as the *formatted value*.

```
[
	'v' => utf8_encode($row->User),
	'f' => (string) '
		<a href ="'.$this->generateUrl('ms.cp.user.admin.detail.edit',
		['userID' => $row->ID]).'">'
		.ucwords(utf8_encode($row->User)).'</a>'
]
```

Any strings which may contain special characters need encoded to UTF-8, as User does in the above example.


The full code used in the User Summary report:

```
	protected function _dataTransform($data, $output = null)
	{
		$result = [];

		if ($output === "json") {

			foreach ($data as $row) {

				$result[] = [
					$row->User ? [
						'v' => utf8_encode($row->User),
						'f' => (string) '<a href ="'.$this->generateUrl('ms.cp.user.admin.detail.edit', ['userID' => $row->ID]).'">'.ucwords(utf8_encode($row->User)).'</a>'
					] : $row->User,
					$row->Email,
					[
						'v' => $row->Created,
						'f' => date('Y-m-d H:i', $row->Created)
					],
				];

			}
			return json_encode($result);

		} else {

			foreach ($data as $row) {
				$result[] = [
					utf8_encode($row->User),
					$row->Email,
					date('Y-m-d H:i', $row->Created),
				];
			}
			return $result;

		}
	}

```

### Filters

#### DateRange

This has two datetime form fields to select a range of data between the two.


#### Date

This is a singular date form field to select data from one specific date.


#### Choices

The Choices form field can be customised depending on what data you are getting in the report.

When adding a choice form you must add the following parameters:

- A unique filter name, it cannot be the same as any other report
- A label for displaying on the form
- The choices
- Whether the field is multiple-choice

```
$this->_filters->add(new Choices(
	"type",
	"Sale Type",
		[
			'Order' => 'Order',
			'Return' => 'Return',
			'Exchange' => 'Exchange',
			'shipping' => 'Shipping',
		],
	true
));
```

### Charts

#### Table

TableChart is currently the only chart available.
https://developers.google.com/chart/interactive/docs/gallery/table

## License

Mothership E-Commerce
Copyright (C) 2015 Jamie Freeman

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
