<?php

namespace Message\Mothership\Report\Filter;

use Message\Cog\ValueObject\Collection as BaseCollection;

class Collection extends BaseCollection
{
	protected function _configure()
	{
		$this->setKey(function($item) {
			return $item->getName();
		});

		$this->setType('Message\\Mothership\\Report\\Filter\\FilterInterface');
	}
}