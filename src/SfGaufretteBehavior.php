<?php
/**
 * This file declare the chGaufretteBehavior class.
 *
 * @package Loopkey
 * @subpackage chCmsContactsPlugin.lib.behavior.propel
 * @author Julien Muetton <julien_muetton@carpe-hora.com>
 * @copyright (c) Carpe Hora SARL 2012
 * @since 2012-01-05
 */

require_once __DIR__ . '/SfGaufretteBehaviorObjectBuilderModifier.php';

/**
 * the chMaskableBehavior class
 */
class SfGaufretteBehavior extends Behavior
{

  protected $parameters = array(
    'name'   => null,
  );

  protected $objectBuilderModifier;

  /* define builders */

  public function getObjectBuilderModifier()
  {
    if (is_null($this->objectBuilderModifier))
    {
      $this->objectBuilderModifier = new SfGaufretteBehaviorObjectBuilderModifier($this);
    }
    return $this->objectBuilderModifier;
  }
}
