<?php

namespace Message\Mothership\Report\Report\AppendQuery;

use Message\Cog\ValueObject\Collection as BaseCollection;

class Collection extends BaseCollection
{
	protected function _configure()
	{
		$this->setType('Message\\Mothership\\Report\\Report\\AppendQuery\\AppendQueryInterface');
	}
}