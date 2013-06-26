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
	 * Holds the id of the root page.
	 *
	 * @var int
	 */
	public $root_id = 16;

	/**
	 * Holds the id of the extra page.
	 *
	 * @var int
	 */
	public $extra_id = 32;
	
	/**
	 * Holds the id of the 'content' region.
	 *
	 * @var int
	 */
	public $region_content_id = 1;

	/**
	 * Holds the root domain for this website.
	 *
	 * @var RedBean_OODBBean
	 */
	public $root;
	
	/**
	 * Holds the extra domain for this website.
	 *
	 * @var RedBean_OODBBean
	 */
	public $extra;
	
	/**
	 * Holds the current location.
	 *
	 * @var string
	 */
	public $location;
	
	/**
	 * Holds the current domain.
	 *
	 * @var RedBean_OODBBean
	 */
	public $domain;

	/**
	 * Container for flattened subdomains of current main domain.
	 *
	 * @var array
	 */
	public $subdomains = array();
	
	/**
	 * Holds the current (main) page.
	 *
	 * @var RedBean_OODBBean
	 */
	public $page;
	
	/**
	 * Container for subpages of current main page.
	 *
	 * @var array
	 */
	public $subpages = array();
	
	/**
	 * Holds the HTML of content region of MTG template.
	 *
	 * @var string
	 */
	public $content;
	
	/**
	 * Holds the name of the sidebar template.
	 *
	 * On portfolio and other this might differ from sidebar.
	 *
	 * @var string
	 */
	public $sidebar_template = 'sidebar';
	
	/**
	 * Oxid eSales view without the language extender.
	 *
	 * These views must be extended by an ISO language code.
	 *
	 * @var array
	 */
	public $oxid_views = array(
		'category' => 'oxv_oxcategories',
		'article' => 'oxv_oxarticles'
	);
	
	/**
	 * Container for oxid categories.
	 *
	 * @var array
	 */
	public $categories = array();
	
	/**
	 * Container for oxid articles.
	 *
	 * @var array
	 */
	public $articles = array();
	
	/**
	 * Container to map oxid article attributes.
	 *
	 * @var array
	 */
	public $attribute_map = array(
	);
	
	/**
	 * Holds the template for an oxid category.
	 *
	 * @var string
	 */
	public $oxid_cat_template = '<header><figure><img src="%2$s" width="100%%" height="320" alt="%1$s" /><figcaption>%1$s</figcaption></figure></header>';
	
	/**
	 * Holds the template for an oxid article.
	 *
	 * @var string
	 */
	public $oxid_art_template = '<tr><td>%1$s</td><td>%2$s</td><td><img src="%3$s" alt="%8$s" /></td><td>%4$s</td><td><img src="%5$s" alt="%2$s" /></td><td>%6$s</td><td>%7$s</td></tr>';

	/**
	 * Constuctor.
	 *
	 * @param string $location
	 */
	public function __construct($location)
	{
		$this->root = R::load('domain', $this->root_id);
		$this->extra = R::load('domain', $this->extra_id);
		$this->location = $location;
		$this->findDomainAndMainPage($this->location);
		if ($this->location == 'portfolio') return $this->portfolio();
		$this->render();
	}
	
	/**
	 * Renders the portfolio page.
	 */
	public function portfolio()
	{
		$this->sidebar_template = 'portfolio';
		$this->getOxidContent(Flight::get('language'));
		$this->render();
	}
	
	/**
	 * Generates the content from the oxid shop.
	 *
	 * For all categories and articles in thoses categories we
	 * create a header and a table.
	 * 
	 * @var string $lang
	 */
	protected function getOxidContent($lang)
	{
		$i18n_empty = I18n::__('mtg_cat_empty');
		R::selectDatabase('oxid');
		//do the twist
		$tablename = $this->oxid_views['category'].'_'.$lang;
		$this->categories = R::getAll('SELECT * FROM '.$tablename.' ORDER BY oxsort');
		
		foreach ($this->categories as $n => $category) {			
			$articles = $this->getArticles($category['OXID'], $lang);
			
			$this->content .= '<article class="category" id="cat-'.$category['OXID'].'">'."\n";
			$this->content .= sprintf($this->oxid_cat_template, $category['OXTITLE'], Flight::get('oxid_path_cat').$category['OXTHUMB'])."\n";
			
			if (empty($articles)) {
				$this->content .= '<p class="empty-cat">'.$i18n_empty.'</p>'."\n";
			} else {
			
				$this->content .= '<table>'."\n";
			
				$this->content .= '<thead>'."\n";
				$this->content .= '<tr>'."\n";
				$this->content .= '<th>Art.-Nr.</th>'."\n";
				$this->content .= '<th>Produkt</th>'."\n";
				$this->content .= '<th>Marke</th>'."\n";
				$this->content .= '<th>Einsatz</th>'."\n";
				$this->content .= '<th>Produktbild</th>'."\n";
				$this->content .= '<th>Größe</th>'."\n";
				$this->content .= '<th>Gebinde</th>'."\n";
				$this->content .= '</tr>'."\n";
				$this->content .= '</thead>'."\n";
			
				$this->content .= '<tbody>'."\n";
				foreach ($articles as $m => $article) {
					$attributes = $this->getAttributes($article['OXID'], $lang);
					$this->content .= sprintf($this->oxid_art_template, $article['OXARTNUM'], $article['OXTITLE'], Flight::get('oxid_path_manu').$article['manu_icon'], $article['OXSHORTDESC'], Flight::get('oxid_path_art').$article['OXPIC1'], $attributes['Größe'], $attributes['Gebinde'], $article['manu_title']);
				}
			
				$this->content .= '</tbody>'."\n";
				$this->content .= '</table>'."\n";
			}
			
			$this->content .= '</article>';
			
		}
		
		R::selectDatabase('default');
	}
	
	/**
	 * Returns an array with articles of the given category.
	 *
	 * @param string $cat_id
	 * @param string $lang
	 * @return array
	 */
	protected function getArticles($cat_id, $lang)
	{
		$sql = <<<SQL
		SELECT
			art.*,
			manu.oxicon AS manu_icon,
			manu.oxtitle AS manu_title
		FROM
			oxv_oxarticles_%1\$s AS art
		LEFT JOIN
			oxobject2category AS cat ON cat.oxobjectid = art.oxid
		LEFT JOIN
			oxv_oxmanufacturers_%1\$s AS manu ON manu.oxid = art.oxmanufacturerid
		WHERE
			cat.oxcatnid = ?
SQL;
		$sql = sprintf($sql, $lang);
		return R::getAll($sql, array($cat_id));
	}
	
	/**
	 * Returns an array with attributes of a given article.
	 *
	 * @param string $article_id
	 * @param string $lang
	 * @return array
	 */
	protected function getAttributes($article_id, $lang)
	{
		$sql = <<<SQL
		SELECT
			attr.oxtitle,
			artattr.oxvalue
		FROM
			oxv_oxobject2attribute_%1\$s AS artattr
		LEFT JOIN
			oxv_oxattribute_%1\$s AS attr ON attr.oxid = artattr.oxattrid
		WHERE
			artattr.oxobjectid = ?
SQL;
		$sql = sprintf($sql, $lang);
		return R::$adapter->getAssoc($sql, array($article_id));
	}

	/**
	 * Find domain and pages.
	 *
	 * @param string $location
	 */
	protected function findDomainAndMainPage($location)
	{
		$this->location = $location;
		$this->domain = R::findOne('domain', 'url = ?', array($location));
		//find main page by domain
		$this->page = R::findOne('page', ' domain_id = ? AND language = ?', array(
			$this->domain->getId(),
			Flight::get('language')
		));
		$this->content = '';
		$this->subdomains = $this->makeContent($this->domain, $this->region_content_id, Flight::get('language'));
	}
	
	/**
	 * Collect all subdomains of the given domain.
	 *
	 * @param RedBean_OODBBean $domain
	 * @param string $lang iso code
	 * @return array
	 */
	protected function makeContent(RedBean_OODBBean $domain, $region_id, $lang)
	{
		//all pages
		$pages = R::find('page', ' domain_id = ? AND language = ?', array(
			$domain->getId(),
			Flight::get('language')
		));
		$this->content .= '<article id="'.$domain->name.'">'."\n";
		$this->content .= '<header><h1>'.$domain->i18n($lang)->name.'</h1></header>'."\n";
		$this->content .= '<div class="tiles">'."\n";
		foreach ($pages as $id => $page) {
			foreach ($page->getSlicesByRegion($region_id, false) as $slice_id => $slice) {
				ob_start();
				echo '<div class="tile tile-'.$slice->module.'">'."\n";
				$slice->render();
				echo '</div>'."\n";
				$content = ob_get_contents();
				ob_end_clean();
				$this->content .= $content;
			}
		}
		$this->content .= '</div>'."\n";
		$this->content .= '</article>'."\n";
		//if domain has subs, render them too
		$subdomains = R::find('domain', 'domain_id = ? ORDER BY sequence', array($domain->getId()));
		foreach ($subdomains as $id => $subdomain) {
			$this->makeContent($subdomain, $region_id, $lang);
		}
	}

	/**
	 * Renders the website.
	 */
	protected function render()
	{
		//render
		Flight::render('mtg/header', array(
			'root' => $this->root,
			'extra' => $this->extra
		), 'header');
		Flight::render('mtg/'.$this->sidebar_template, array(
			'domain' => $this->domain,
			'categories' => $this->categories
		), 'sidebar');
        Flight::render('mtg/html5', array(
            'title' => $this->page->name,
            'language' => Flight::get('language'),
			'page_id' => $this->location,
			'content' => $this->content
        ));
	}
}
