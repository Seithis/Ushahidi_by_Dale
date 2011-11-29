<?php
/**
 * Performs install/uninstall methods for the revision request plugin. Note, nothing
 * actually really gets done here.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Dale Douglas 
 */

class Revision_Install {

	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Installs the revision request plugin. Note, there is nothing that actually
	 * needs to be added.
	 */
	public function run_install()
	{
		
	}

	/**
	 * Uninstalls the revision request plugin. Note, there is nothing that actually
	 * needs to be removed.
	 */
	public function uninstall()
	{}
}
