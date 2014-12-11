<?php

namespace Message\Mothership\Report\Filter;

/**
 * @author Sam Trangmar-Keates <sam@message.co.uk>
 *
 * An interface for all filters to implement
 */
interface FilterInterface
{
	/**
	 * Gets the filter name.
	 *
	 * @return string name of the filter
	 */
	public function getName();

	/**
	 * Gets the form for this filter
	 *
	 * @return AbstractType the form
	 */
	public function getForm();
}