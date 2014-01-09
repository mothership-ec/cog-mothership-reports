<?php

namespace UniformWares\Reports\Collection;

/**
 * Collection item model.
 *
 * @author Joe Holdcroft <joe@message.co.uk>
 * @author Laurence Roberts <laurence@message.co.uk>
 */
class Item
{
	public $key;
	public $value;

	/**
	 * Constructor
	 *
	 * @param int    $key Item key
	 * @param string $value Item value
	 */
	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * Get this item as a string.
	 *
	 * @return string The item key & value as "(key) value"
	 */
	public function __toString()
	{
		return sprintf('(%d) %s', $this->code, $this->value);
	}
}