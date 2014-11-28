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
	 * @todo  fix the requirement stated below
	 * NOTE: for the data transform to work, currenly the name of the form MUST 
	 * be $this->getName() . '_form'
	 * 
	 * @return AbstractType the form
	 */
	public function getForm();
}