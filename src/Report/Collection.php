<?php

namespace Message\Mothership\Report\Report;

use Message\Cog\ValueObject\Collection as BaseCollection;

class Collection extends BaseCollection
{
	public function _configure()
	{
		$this->setKey('name');
	}
}