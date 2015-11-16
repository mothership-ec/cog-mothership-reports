<?php

namespace Message\Mothership\Report\Filter;

class Choices implements FilterInterface
{
	private $_filterName;
	private $_label;
	private $_choices;
	private $_multichoice;
	private $_formChoices = null;

	/**
	 * Constructor.
	 *
	 * @param String  $filterName    The unique filter name.
	 * @param String  $label         The label for the form field.
	 * @param Array   $choices       The choices for the form field.
	 * @param Bool    $multichoice   If the form is multiple choice.
	 */
	public function __construct($filterName, $label = null, $choices = null, $multichoice = false)
	{
		$this->_filterName  = $filterName;
		$this->_label       = $label;
		$this->_choices     = $choices;
		$this->_multichoice = $multichoice;
	}

	/**
	 * Gets the form for the filter.
	 *
	 * @return Form\DateRange the form
	 */
	public function getForm()
	{
		$choices = $this->_formChoices === null
			? array_combine($this->_choices, $this->_choices)
			: $this->_formChoices
		;

		return new Form\Choices($this->_label, $choices, $this->_multichoice, $this->_filterName);
	}

	/**
	 * Gets the name of the filter.
	 *
	 * @return string the name
	 */
	public function getName()
	{
		return $this->_filterName;
	}

	/**
	 * Gets the type to filter
	 *
	 * @return string the type
	 */
	public function getLabel()
	{
		return $this->_label;
	}

	/**
	 * Gets the type to filter
	 *
	 * @return array|string the type
	 */
	public function getChoices()
	{
		return $this->_choices;
	}

	/**
	 * Gets if it allows multiple choice
	 *
	 * @return bool
	 */
	public function getMultichoice()
	{
		return $this->_multichoice;
	}

	/**
	 * Sets the choices to filter
	 *
	 * @param  $choices array | mixed
	 *
	 * @return String the choices
	*/
	public function setChoices($choices)
	{
		return $this->_choices = $choices;
	}

	/**
	 * Set the choices as they will appear on the form. In versions 2.0.0 and earlier the forms would populate with
	 * choices set in `$_choices`, but this causes problems as this property is also used for storing form data
	 * values, so should this method should be used instead. If this method is not used the filter will default to
	 * its original behaviour.
	 *
	 * @param $choices
	 *
	 * @return $this
	 */
	public function setFormChoices($choices)
	{
		$this->_formChoices = $choices;

		return $this;
	}
}