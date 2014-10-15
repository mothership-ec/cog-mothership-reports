<?php

namespace Message\Mothership\Report\Event;

use Message\Cog\Event\Event;

class ReportEvent extends Event
{
	const REGISTER_REPORTS = 'ms.report.reports_collection.build';
}