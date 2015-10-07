# Changelog

## 2.2.0

- Added `Filter\Form\DateRange::setType()` method for setting the form fields to either `date` or `datetime`. Defaults to `datetime` if not set.
- Added `Filter\DateRange::setFormType()` method which calls `Filter\Form\DateRange::setType()` to set the form field type for the filter.

## 2.1.0

- Added `Filter\ModifyQueryInterface` interface representing filter classes that can modify a query builder instance before the data is loaded
- Added `Filter\Choices::setFormChoices()` method for separating choices that appear in the form compared to data that is sent to the form. The original method `setChoices()` acted as both which is an anti-pattern, and meant that associative arrays given as choices would return invalid data. If not called, it will default to previous behaviour.
- If `Filter\Choices::$_choices` is an associative array, it will no longer set the values as keys to be sent to the form

## 2.0.0

- Initial open source release