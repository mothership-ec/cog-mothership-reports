<?php

namespace Message\Mothership\Report\Filter\Form;

use Symfony\Component\Form\DataTransformerInterface;
use Message\Mothership\Report\Filter\Collection as FilterCollection;

class DataTransformer implements DataTransformerInterface
{
	private $_filters;

	/**
	 * Constructor.
	 *
	 * @param \FilterCollection   $filters
	 */
	public function __construct(FilterCollection $filters)
	{
		$this->_filters = $filters;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @todo Implement
	 */
	public function transform($val)
	{
		return [];
	}

	/**
	 * {@inheritDoc}
	 */
	public function reverseTransform($val)
	{
		foreach ($val as $filter => $data) {
			try {
				$filter = $this->_filters->get($filter);
			} catch (\InvalidArgumentException $e) {
				throw new \InvalidArgumentException("Filter $filter not found on collecton. Make sure it is added to the collection of available filters");
			}

			foreach($data as $attr => $val){
				try {
					$filter->{'set'.$attr}($val);
				} catch (\Exception $e) {
					throw new \LogicException("Could not set $attr on filter of class " . get_class($filter)); // todo
				}
			}
		}

		return $this->_filters;
	}
}