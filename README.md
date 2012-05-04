sfGaufretteBehavior
=================

Example :  author
----------------------------

``` xml
<database name="propel" defaultIdMethod="native" package="lib.model">
  <behavior name="sf_context" />

  <table name="author">
    <column name="id" type="INTEGER" required="true" primaryKey="true" autoIncrement="true" />
    <column name="name" type="VARCHAR" size="255" />
    <column name="avatar" type="VARCHAR" size="255" />
    
    <behavior name="sf_gaufrette">
      <parameter name="name" value="avatar_gaufrette" />
    </behavior>
  </table>

</database>
```
update your Active record class ass follow

```php
  public function getGaufrette($name = 'avatar_gaufrette')
  {
  
    if (sfContext::hasInstance())
    {
      $sf_context = $this->getApplicationContext();
      
      return $sf_context->getGaufrette($name);
    }
    else
    {
      $sfDefineEnvironmentConfigHandler = new sfDefineEnvironmentConfigHandler();
      $config = sfFactoryConfigHandler::getConfiguration(array(sfConfig::get('sf_app_config_dir').'/app.yml'));
      sfConfig::add($config);
  
      $gaufretteFactory = new sfGaufretteFactory();
      $gaufrette = $gaufretteFactory->get($name);
      
      return $gaufrette;
    }
  }
```

Description
-----------

This behavior add a specific gaufrette to related object.

To access gaufrette, just call ```getGaufrette()``` method.
If you want to use another gaufrette that the default you gave in you schema juste give the gaufrette name ```getGaufrette('my_gaufrette_name')```


Dependency
-----------

To use this behavior you need :

- [sfGaufrettePlugin](https://github.com/themouette/sfGaufrettePlugin)
- [sfContextBehavior](https://github.com/Carpe-Hora/sfContextBehavior)

Installation
------------

Install the behavior in your vendor directory

```
git submodule add git://github.com/Carpe-Hora/sfGaufretteBehavior.git lib/vendor/sfGaufretteBehavior
```

add following to your ```propel.ini``` file:

``` ini
propel.behavior.sf_gaufrette.class               = lib.vendor.sfGaufretteBehavior.src.SfGaufretteBehavior
```

Declare behavior for a table in your ```config/schema.xml```

``` xml
<database name="propel" defaultIdMethod="native" package="lib.model">
  <table name="my_table">
    <column name="id" type="integer" required="true" primaryKey="true" autoIncrement="true" />
    <behavior name="sf_gaufrette">
      <parameter name="name" value="my_gaufrette_name" />
    </behavior>
  </table>
</database>
```


