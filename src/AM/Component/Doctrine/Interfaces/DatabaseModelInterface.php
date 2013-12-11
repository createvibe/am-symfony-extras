<?php
/**
 * 
 * @author Anthony Matarazzo <email@anthonymatarazzo.com>
 */

namespace AM\Component\Doctrine\Interfaces;

/**
 * Interface DatabaseModelInterface
 *
 * @package AM\Component\Doctrine\Interfaces
 */
interface DatabaseModelInterface
{
	/**
	 * Set the id for this record
	 * @param mixed $id
	 * @return mixed
	 */
	public function setId($id);

	/**
	 * Get the id for this record
	 * @return mixed
	 */
	public function getId();
} 