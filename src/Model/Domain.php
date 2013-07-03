<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Domain model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Domain extends Model
{
    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'domain.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'url',
                'sort' => array(
                    'name' => 'domain.url'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'sequence',
                'sort' => array(
                    'name' => 'domain.sequence'
                ),
                'filter' => array(
                    'tag' => 'number'
                )
            )
        );
    }
    
    /**
     * Builds a hierarchical menu from an adjancy bean.
     *
     * @param string (optional) $url_prefix as a kind of basehref, e.g. 'http://localhost/s/de'
     * @param string (optional) $lng code of the language to retrieve
     * @param string (optional) $orderclause defaults to 'sequence'
     * @param bool (optional) $invisibles default to false so that invisible beans wont show up
     * @return Cinnebar_Menu
     */
    public function hierMenu($url_prefix = '', $lng = null, $order = 'sequence ASC', $invisible = false)
    {
        $sql_invisible = 'AND invisible != 1';
        if ($invisible) {
            $sql_invisible = null;
        }
        $sql = sprintf(
            '%s = ? %s ORDER BY %s',
            $this->bean->getMeta('type').'_id',
            $sql_invisible, $order
        );
        $records = R::find(
            $this->bean->getMeta('type'),
            $sql,
            array($this->bean->getId())
        );
        $menu = new Menu();
        foreach ($records as $record) {
            $menu->add(
                $record->i18n($lng)->name,
                Url::build($url_prefix.$record->url),
                $record->getMeta('type').'-'.$record->getId(),
                $record->hierMenu($url_prefix, $lng, $order, $invisible)
            );
        }
        return $menu;
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->bean->invisible = false;
        $this->bean->blessed = false;
        $this->bean->sequence = 0;
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
    }
}