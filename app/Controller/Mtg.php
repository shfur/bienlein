<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Mtg controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Mtg extends Controller
{
    /**
     * Renders the index/home page.
     */
    public function index()
    {
		Flight::render('mtg/header', array(), 'header');
        Flight::render('mtg/html5', array(
            'title' => I18n::__('welcome_head_title'),
            'language' => Flight::get('language'),
			'content' => '<h1>HOME</h1>'
        ));
    }

	/**
     * Renders the company page.
     */
    public function company()
    {
		$page = R::find('page', ' url = ?', array('mtg-home')); //find page by url
		$subnav = array(
            array(
                'url' => '#firma',
                'name' => 'Firma'
            ),
            array(
                'url' => '#philosophie',
                'name' => 'Philosophie'
            ),
            array(
                'url' => '#service',
                'name' => 'Service'
            ),
            array(
                'url' => '#zertifizierung',
                'name' => 'Zertifizierung'
            )
        );
		Flight::render('mtg/header', array(), 'header');
		Flight::render('mtg/sidebar', array(
			'subnav' => $subnav
		), 'sidebar');
        Flight::render('mtg/html5', array(
            'title' => htmlspecialchars($page->name),
            'language' => Flight::get('language'),
			'content' => '<header><h1>COMPANY</h1></header>'
        ));
    }
}
