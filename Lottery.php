<?php

 /*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 /**
 * Lottery class
 * @author     	Rafal Strojek <strojek.rafal@gmail.com>
 * @copyright  	2014 (c) Rafal Strojek
 * @version		0.1
 */

class Lottery
{
	/**
	 * Default parameters
	 */
	private $params = array();
	
	/**
	 * Constructor
	 *
	 * @param	array  $params  User-defined parameters
	 */
	public function __construct(array $params)
	{
		$this->params = array_merge($this->getDefaultParameters(),$params);
	}
	
	/**
	 * Gets default parameters
	 *
	 * @return  array  Default Parameters
	 */
	public function getDefaultParameters()
	{
		return array(
			'from' => 1, 
			'to' => 49,
			'seed' => mt_rand(),
		);
	}
	
	/**
	 * Gets parameters
	 *
	 * @return  array  Lottery parameters
	 */
	public function getParameters()
	{
		return $this->params;
	}
}
