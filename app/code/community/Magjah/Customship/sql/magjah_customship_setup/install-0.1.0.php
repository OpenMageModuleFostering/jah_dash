<?php
$installer = $this;
$installer->startSetup();
$connection = $installer->getConnection();
$connection->dropTable($this->getTable('magjah_customship/customship'));
$table = $installer->getConnection()
    ->newTable($installer->getTable('magjah_customship/customship'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_BIGINT, 15, array(
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'id')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, NULL, array(
        'nullable' => false,
        'default'  => 0
    ), 'website_id')
    ->addColumn('dest_country', Varien_Db_Ddl_Table::TYPE_TEXT, NULL, array(
        'nullable' => false,
        'default'  => ''
    ), 'dest_country')
    ->addColumn('condition_title', Varien_Db_Ddl_Table::TYPE_TEXT, NULL, array(
        'nullable' => false,
        'default'  => ''
    ), 'condition_title')
    ->addColumn('value_condition_f', Varien_Db_Ddl_Table::TYPE_DECIMAL,'12,4', array(
        'nullable' => false,
        'default'  => 0.0000
    ), 'value_condition_f')
    ->addColumn('value_condition_t', Varien_Db_Ddl_Table::TYPE_DECIMAL,'12,4', array(
        'nullable' => false,
        'default'  => 0.0000
    ), 'value_condition_t')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL,'12,4', array(
        'nullable' => false,
        'default'  => 0.0000
    ), 'price')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, NULL, array(
        'nullable' => false,
        'default'  => ''
    ), 'status')
;
$installer->getConnection()->createTable($table);
$installer->endSetup();

