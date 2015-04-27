<?php 
App::import("Vendor", "FacebookAuto", array("file" => "facebook-php-sdk-v4-4.0-dev/autoload.php"));

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
	public $components = array('Session','Cookie','Auth');

	function beforeFilter(){
		$this->Auth->allow();


	
	/*function beforeFilter() {
		
		// Define your 
		if($this->Session->check('User')){
			$menu = array(
					'left-menu' => array(
							array(
									'title' => 'Mes Listes',
									'url' => array('controller' => 'todolists', 'action' => 'meslists'),								
							),
							array(
									'title' => 'Creer une Liste',
									'url' => array('controller' => 'todolists', 'action' => 'add'),
							),
							array(
									'title' => 'Afficher un profil',
									'url' => array('controller' => 'users', 'action' => 'profil'),
							),
							array(
									'title' => 'Mon compte',
									'url' => array('controller' => 'users', 'action' => 'profil'),
							),
							array(
									'title' => 'Notifications',
									'url' => array('controller' => 'notifications', 'action' => 'view'),
							),
							array(
									'title' => 'Deconnexion',
									'url' => array('controller' => 'users', 'action' => 'deconnexion'),
							),
					),
			);
		}
		else{
			$menu = array(
					'left-menu' => array(
							array(
									'title' => 'Connexion',
									'url' => array('controller' => 'users', 'action' => 'connect'),
							),
					),
			);

		}
	
		// For default settings name must be menu
		$this->set(compact('menu'));
	*/

	}
}
