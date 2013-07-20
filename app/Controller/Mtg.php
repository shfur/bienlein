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
	 * Container for news.
	 *
	 * @var array
	 */
	public $news = array();
	
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
	public $oxid_cat_template = '<header><h1>%1$s</h1><figure><img src="%2$s" width="100%%" height="320" alt="%1$s" /><figcaption>%1$s</figcaption></figure></header>';
	
	/**
	 * Holds the thead template for a non-logged user.
	 *
	 * @var string
	 */
	public $oxid_thead_template_guest = '<thead><tr><th class="fn-artno">%1$s</th><th class="fn-product">%2$s</th><th class="fn-thumb">%5$s</th><th class="fn-package">%7$s</th><th class="fn-tgtk">%9$s</th><th class="fn-brand">%3$s</th><th class="fn-usage">%4$s</th></tr></thead>';

	/**
	 * Holds the thead template for a logged user.
	 *
	 * @var string
	 */
	public $oxid_thead_template_cust = '<thead><tr><th class="fn-artno">%1$s</th><th class="fn-product">%2$s</th><th class="fn-thumb">%5$s</th><th class="fn-package">%7$s</th><th class="fn-tgtk">%8$s</th><th class="fn-brand">%3$s</th><th class="fn-usage">%4$s</th><th class="fn-avail">%9$s</th></tr></thead>';

	/**
	 * Holds the template for an oxid article.
	 *
	 * @var string
	 */
	public $oxid_art_template_guest = '<tr><td>%1$s</td><td>%2$s</td><td><img src="%5$s" alt="%2$s" width="60px" height="auto" /></td><td>%7$s</td><td>%9$s</td><td><img src="%3$s" title="%10$s" alt="%8$s" width="72px" height="auto" /></td><td>%4$s</td></tr>';
	
	/**
	 * Holds the template for an oxid article when user is logged in.
	 *
	 * This has one table data cell more.
	 *
	 * @var string
	 */
	public $oxid_art_template_cust = '<tr><td>%1$s</td><td><a href="/portfolio/%12$s">%2$s</a></td><td><img src="%5$s" alt="%2$s" width="60px" height="auto" /></td><td>%7$s</td><td>%9$s</td><td><img src="%3$s" title="%10$s" alt="%8$s" width="72px" height="auto" /></td><td>%4$s</td><td>%11$s</td></tr>';
	
	/**
	 * Holds the last entered searchterm.
	 *
	 * @var string
	 */
	public $q;
	
	/**
	 * Holds the instance of the logged oxid user or false.
	 *
	 * @var mixed
	 */
	public $oxuser;

	/**
	 * Constuctor.
	 *
	 * Most pages are cms like, but portfolio, login and logout are special.
	 *
	 * @param string $location
	 */
	public function __construct($location)
	{
		session_start();
		if ( ! isset($_SESSION['oxuser'])) {
			$_SESSION['oxuser'] = false;
		}
		$this->oxuser = $_SESSION['oxuser'];
		$this->root = R::load('domain', $this->root_id);
		$this->extra = R::load('domain', $this->extra_id);
		$this->location = $location;
		$this->findDomainAndMainPage($this->location);
	}
	
	/**
	 * Dispatcher.
	 */
	public function run()
	{
		if ($this->location == 'login') return $this->login();
		if ($this->location == 'logout') return $this->logout();
		if ($this->location == 'portfolio') return $this->portfolio();
		if ($this->location == 'home') return $this->home();
		$this->render();
	}


	/**
	 * Log in to oxid user account.
	 */
	public function login()
	{
		$mtg_login_failed = I18n::__('mtg_login_failed');
		R::selectDatabase('oxid');
		$sql = 'SELECT oxid, oxfname, oxlname FROM oxuser WHERE oxusername = ? AND oxactive = 1 AND oxpassword = MD5(CONCAT(?, UNHEX(oxpasssalt)))';
		$users = R::getAll($sql, array(
			Flight::request()->data->uname,
			Flight::request()->data->pw
		));
		R::selectDatabase('default');//before doing session stuff we have to return to db
		if ( ! empty($users) && count($users) == 1) {
			$_SESSION['oxuser'] = array(
				'id' => $users[0]['oxid'],
				'name' => $users[0]['oxfname'].' '.$users[0]['oxlname']
			);
		} else {
			$_SESSION['msg'] = $mtg_login_failed;
		}
		$this->redirect(Flight::request()->data->goto);
	}
	
	/**
	 * Log out.
	 */
	public function logout()
	{
		$_SESSION['oxuser'] = false;
		$this->redirect('/home');
	}

	
	/**
	 * Renders the home page with news.
	 */
	public function home()
	{
		$this->sidebar_template = 'news';
		$this->news = R::dispense('news', 5);
		$this->render();
	}
	
	/**
	 * Renders the portfolio page.
	 */
	public function portfolio()
	{
		$this->sidebar_template = 'portfolio';
		$this->q = Flight::request()->query->q;
		if ( ! $this->oxuser) 
				$this->content .= Flight::textile(I18n::__('mtg_login_to_see_details'));
		$this->getOxidContent(Flight::get('language'));
		$this->render();
	}
	
	/**
	 * Displays a product detail page.
	 *
	 * @param string $oxartid
	 */
	public function productDetail($oxartid)
	{
		if ( ! $this->oxuser) {
			//echo 'You are not logged in';
			$this->redirect('/');
			return;
		}
		$this->sidebar_template = 'pdetaillegend';
		$this->page = R::dispense('page');
		R::selectDatabase('oxid');
		$articles = $this->getArticleById($oxartid, Flight::get('language'));
		$attributes = $this->getAttributes($oxartid, Flight::get('language'));
		$files = $this->getFilesByArtId($oxartid);
		R::selectDatabase('default');
		if (empty($articles)) {
			echo 'No article';
			return;
		}
		$article = reset($articles);
		$this->page->name = htmlspecialchars(strip_tags($article['OXTITLE']));
		ob_start();
		Flight::render('mtg/pdetail', array(
			'article' => $article,
			'attributes' => $attributes,
			'files' => $files
		));
		$this->content = ob_get_contents();
		ob_end_clean();
		$this->render();
	}
	
	/**
	 * Send a product pdf to the client.
	 */
	public function download()
	{
		R::selectDatabase('oxid');
		$files = $this->getFilesByName(Flight::request()->query->file);
		if (empty($files)) $this->redirect('/');
		$file = reset($files);
		$dwnloadDir = substr($file['OXSTOREHASH'], 0, 2);
		$dwnloadFile = Flight::get('oxid_dir_downloads').$dwnloadDir.'/'.$file['OXSTOREHASH'];
		if ( ! is_file($dwnloadFile)) $this->redirect('/');
		//error_log($dwnloadFile);
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="'.$file['OXFILENAME'].'"');
		@readfile($dwnloadFile);
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
		$avail = array(
			'1' => I18n::__('mtg_avail_1'),
			'2' => I18n::__('mtg_avail_2'),
			'3' => I18n::__('mtg_avail_3'),
			'4' => I18n::__('mtg_avail_4')
		);
		
		if ($this->oxuser) {
			$thead_template = sprintf($this->oxid_thead_template_cust,
					I18n::__('mtg_th_artno'),
					I18n::__('mtg_th_product'),
					I18n::__('mtg_th_manufacturer'),
					I18n::__('mtg_th_desc'),
					I18n::__('mtg_th_thumb'),
					I18n::__('mtg_th_size'),
					I18n::__('mtg_th_package'),
					I18n::__('mtg_th_tgtk'),
					I18n::__('mtg_th_ls')
			);
			$art_template = $this->oxid_art_template_cust;
		} else {
			$thead_template = sprintf($this->oxid_thead_template_guest,
			 		I18n::__('mtg_th_artno'),
					I18n::__('mtg_th_product'),
					I18n::__('mtg_th_manufacturer'),
					I18n::__('mtg_th_desc'),
					I18n::__('mtg_th_thumb'),
					I18n::__('mtg_th_size'),
					I18n::__('mtg_th_package'),
					'',
					I18n::__('mtg_th_tgtk'));
			$art_template = $this->oxid_art_template_guest;
		}
		
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
			
				$this->content .= $thead_template;
			
				$this->content .= '<tbody>'."\n";
				foreach ($articles as $m => $article) {
					$attributes = $this->getAttributes($article['OXID'], $lang);
					$this->content .= sprintf($art_template,
							$article['OXARTNUM'],
							$article['OXTITLE'],
							Flight::get('oxid_path_manu').$article['manu_icon'],
							$article['OXSHORTDESC'],
							Flight::get('oxid_path_art').$article['OXPIC1'],
							$attributes['Größe'],
							$attributes['Gebinde'],
							$article['manu_title'],
							$attributes['TG/TK'],
							$article['manu_shortdesc'],
							'<div title="'.$avail[$article['OXSTOCKFLAG']].'" class="avail avail-'.$article['OXSTOCKFLAG'].'">&nbsp;</div>',
							$article['OXID']
					);
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
			manu.oxtitle AS manu_title,
			manu.oxshortdesc AS manu_shortdesc
		FROM
			oxv_oxarticles_%1\$s AS art
		LEFT JOIN
			oxobject2category AS cat ON cat.oxobjectid = art.oxid
		LEFT JOIN
			oxv_oxmanufacturers_%1\$s AS manu ON manu.oxid = art.oxmanufacturerid
		WHERE
			cat.oxcatnid = ?
		ORDER BY
			cat.oxpos, art.oxartnum
SQL;
		$sql = sprintf($sql, $lang);
		return R::getAll($sql, array($cat_id));
	}
	
	/**
	 * Returns an array with one article found by oxseo::url.
	 *
	 * @param string $oxartid
	 * @param string $lang
	 * @return array
	 */
	protected function getArticleById($oxartid, $lang)
	{
		$sql = <<<SQL
		SELECT
			art.*,
			manu.oxicon AS manu_icon,
			manu.oxtitle AS manu_title,
			manu.oxshortdesc AS manu_shortdesc,
			artextend.oxlongdesc AS OXLONGDESC
		FROM
			oxv_oxarticles_%1\$s AS art
		LEFT JOIN
			oxobject2category AS cat ON cat.oxobjectid = art.oxid
		LEFT JOIN
			oxv_oxmanufacturers_%1\$s AS manu ON manu.oxid = art.oxmanufacturerid
		LEFT JOIN
			oxv_oxartextends_%1\$s AS artextend ON artextend.oxid = art.oxid
		WHERE
			art.oxid = ?
SQL;
		$sql = sprintf($sql, $lang);
		return R::getAll($sql, array($oxartid));
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
	 * Returns an array with files attached to the given article.
	 *
	 * @param string $article_id
	 * @return array
	 */
	protected function getFilesByArtId($article_id)
	{
		$sql = <<<SQL
		SELECT
			*
		FROM
			oxfiles
		WHERE
			OXARTID = ?
		ORDER BY
			OXTIMESTAMP
SQL;
		//$sql = sprintf($sql);
		return R::getAll($sql, array($article_id));
	}
	
	/**
	 * Returns an array with oxfiles with given name.
	 *
	 * @param string $filename
	 * @return array
	 */
	protected function getFilesByName($filename)
	{
		$sql = <<<SQL
		SELECT
			*
		FROM
			oxfiles
		WHERE
			OXFILENAME = ?
SQL;
		//$sql = sprintf($sql);
		return R::getAll($sql, array($filename));
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
		if ( ! $this->domain) return;
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
			$lang
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
			'extra' => $this->extra,
			'oxuser' => $this->oxuser
		), 'header');
		Flight::render('mtg/'.$this->sidebar_template, array(
			'domain' => $this->domain,
			'categories' => $this->categories,
			'q' => $this->q,
			'news' => $this->news
		), 'sidebar');
        Flight::render('mtg/html5', array(
            'title' => $this->page->name,
            'language' => Flight::get('language'),
			'page_id' => $this->location,
			'content' => $this->content
        ));
	}
}
