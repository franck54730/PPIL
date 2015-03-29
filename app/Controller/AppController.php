<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array('MenuBuilder.MenuBuilder');
	
	function beforeFilter() {
		
		// Define your menu
		$menu = array(
				'left-menu' => array(
						array(
								'title' => 'Mes Listes',
								'url' => array('controller' => 'items', 'action' => 'view', 1),								
						),
						array(
								'title' => 'Creer une Liste',
								'url' => array('controller' => 'items', 'action' => 'view', 2),
						),
						array(
								'title' => 'Afficher un profil',
								'url' => array('controller' => 'items', 'action' => 'view', 2),
						),
						array(
								'title' => 'Mon compte',
								'url' => array('controller' => 'items', 'action' => 'view', 2),
						),
						array(
								'title' => 'Notifications',
								'url' => array('controller' => 'items', 'action' => 'view', 2),
						),
						array(
								'title' => 'Deconnexion',
								'url' => array('controller' => 'items', 'action' => 'view', 2),
						),
				),
		);
	
		// For default settings name must be menu
		$this->set(compact('menu'));
	
	}
}
