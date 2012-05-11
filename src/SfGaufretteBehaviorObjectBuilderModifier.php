<?php
/**
 * This file declare the chGaufretteBehaviorObjectBuilderModifier class.
 *
 * @package Loopkey
 * @subpackage chCmsContactsPlugin.lib.behavior.propel
 * @author Fabien Pomerol <fabien_pomerol@carpe_hora.com>
 * @copyright (c) Carpe Hora SARL 2012
 * @since 2012-01-10
 */

/**
 * chMaskable behavior object builder
 */
class SfGaufretteBehaviorObjectBuilderModifier
{
  protected $behavior, $table, $builder, $objectClassname, $peerClassname;

  public function objectMethods($builder)
  {
    $this->setbuilder($builder);

    $script = "";
    $script .= $this->getGaufretteMethods();

    return $script;
  }

  /**
   * getGaufrette methods
   */
  protected function getGaufretteMethods()
  {
    $script = <<<EOF

/**
 * Get the given gaufrette
 *
 * @return String
 */
public function getGaufrette(\$name = '{$this->getParameter('name')}')
{

  if (sfContext::hasInstance())
  {
    \$sf_context = \$this->getApplicationContext();
    return \$sf_context->getGaufrette(\$name);
  }
  else
  {
    \$configuration = ProjectConfiguration::getApplicationConfiguration('{$this->getParameter('cli_app')}', 'cli', false);
    \$configCache = new sfConfigCache(\$configuration);

    \$gaufretteFactory = new sfGaufretteFactory(\$configCache);
    \$gaufrette = \$gaufretteFactory->get(\$name);
    return \$gaufrette;
  }
}
EOF;
    return $script;
  }

  public function __construct($behavior)
  {
    $this->behavior = $behavior;
    $this->table = $behavior->getTable();
  }

  protected function setBuilder($builder)
  {
    $this->builder = $builder;
    $this->objectClassname = $builder->getStubObjectBuilder()->getClassname();
    $this->queryClassname = $builder->getStubQueryBuilder()->getClassname();
    $this->peerClassname = $builder->getStubPeerBuilder()->getClassname();
  }

  protected function getParameter($key)
  {
    return $this->behavior->getParameter($key);
  }
}
