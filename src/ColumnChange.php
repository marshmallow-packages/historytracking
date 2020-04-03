<?php

namespace Marshmallow\HistoryTracking;

class ColumnChange
{
	/**
	 * [$column holds the column that has been changed]
	 * @var [string]
	 */
	public $column;

	/**
	 * [$from holds the value it was changed from]
	 * @var [string]
	 */
	public $from;

	/**
	 * [$to holds the value it has been changed to]
	 * @var [string]
	 */
	public $to;

	/**
	 * Contructer for a changed column class
	 * 
	 * @param string $column
	 * @param string $from
	 * @param string $to
	 */
	public function __construct ($column, $from, $to)
	{
		$this->column = $column;
		$this->from = $from;
		$this->to = $to;
	}
}