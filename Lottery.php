<?php

 /*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 /**
 * Lottery class
 *
 * @author      Rafal Strojek <strojek.rafal@gmail.com>
 * @copyright   2014 (c) Rafal Strojek
 * @version     0.1
 */

class Lottery
{
	/**
	 * Default parameters
	 */
	private $params = array();
	
	/**
	 * Numbers to drawn
	 */
	private $numbers = array();
	
	/**
	 * Constructor
	 *
	 * @param   array  $params  User-defined parameters
	 */
	public function __construct($params = array())
	{
		$this->params = array_merge($this->getDefaultParameters(),$params);
		$this->numbers = range($this->params['from'], $this->params['to'], 1);
		
		$this->seedRand();
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
			'numbers' => 6,
			'seed' => (int) ((float) microtime() * 1000000),
			'pow' => pow(2,24),
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
	
	public function getSeed()
	{
		return (int) $this->params['seed'];
	}
	
	private function setSeed($seed = null)
	{
		$this->params['seed'] = ($seed) ? $seed : $this->makeSeed();

		// Return instance to shortcut
		return $this;
	}
	
	private function seedRand()
	{
		mt_srand($this->getSeed());
	}
	
	private function makeSeed()
	{
		return (int) ((mt_rand() + ((float) microtime() * 1000000)) % $this->params['pow']);
	}
	
	public function createTicket()
	{
		$ticket = array();
		$array = $this->numbers;
		
		for($i = 0; $i < $this->params['numbers']; $i++)
		{
			$this->setSeed()->seedRand();
			$key = mt_rand(0, (count($array) - 1));
			
			$ticket[$i] = $array[$key];
			array_splice($array, $key, 1);
		}
		
		asort($ticket);
		
		return $ticket;
	}
	
	public function createTickets($count = null)
	{
		if($count <= 0)
		{
			return array();
		}
		
		$count = min(500, max(1, $count));
		$tickets = array();
		for($i = 0; $i < $count; $i++)
		{
			$tickets[$i] = $this->createTicket();
		}
		
		return $tickets;
		
	}
}
