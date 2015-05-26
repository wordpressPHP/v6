<?php
/**
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2015. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@cubecart.com
 * License:  GPL-3.0 https://www.gnu.org/licenses/quick-guide-gplv3.html
 */

/**
 * Configuration controller
 *
 * @since 5.0.0
 */
class SSL {

	/**
	 * SSL enabled pages
	 * @var array
	 */
	private $_ignored_pages  = array('remote' => true, 'rm' => true);

	/**
	 * Class instance
	 *
	 * @var instance
	 */
	protected static $_instance;

	##############################################

	public function __construct() {

		if ($GLOBALS['config']->get('config', 'ssl') && !ADMIN_CP && !CC_SSL && !in_array($_GET['_g'], $this->_ignored_pages)) {
			$current_url = currentPage();
			$current_url = preg_replace('#^http://#','https://',$current_url);
			
			$ssl_url = $GLOBALS['config']->get('config', 'ssl_url');
			
			// Make sure the domain is specified?!
			if(preg_match('#^'.$ssl_url.'#',$current_url)) {
				httpredir($current_url);
			} else {
				httpredir($ssl_url);
			}
		}
	}

	/**
	 * Setup the instance (singleton)
	 *
	 * @return SSL
	 */
	public static function getInstance() {
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	//=====[ Public ]=======================================

	/**
	 * Define a custom page to ignore SSL
	 *
	 * @param array/string $input
	 * @return bool
	 */
	public function defineIgnorePage($input = null) {
		if (!is_null($input)) {
			if (is_array($input)) {
				foreach ($input as $section) {
					$this->_ignored_pages[$section] = true;
				}
			} else {
				$this->_ignored_pages[$input] = true;
			}

		}
		return false;
	}

	//=====[ Public Defunct Functions ]=======================================

	/**
	 * Define a custom page to use SSL
	 *
	 * @param array/string $input
	 * @param bool $secure
	 * @return false
	 */
	public function defineSecurePage($input = null, $secure = true) {
		return false;
	}

	/**
	 * Force SSL
	 *
	 * @param bool $default
	 * @return false
	 */
	public function sslForce($default = true) {
		return false;
	}

	//=====[ Private ]=======================================

	/**
	 * Switch to SSL
	 *
	 * @param bool $force
	 * @return false
	 */
	private function _sslSwitch($force = false) {
		return false;
	}
}