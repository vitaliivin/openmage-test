<?php

$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('sales/quote_payment'),
        'cstm_paymentamnt',
        [
            'type'      => Varien_Db_Ddl_Table::TYPE_VARCHAR,
            'nullable'  => false,
            'length'    => 255,
            'after'     => null,
            'comment'   => 'Custom payment amount'
        ]
    );

$installer->getConnection()
    ->addColumn($installer->getTable('sales/order_payment'),
        'cstm_paymentamnt',
        [
            'type'      => Varien_Db_Ddl_Table::TYPE_VARCHAR,
            'nullable'  => false,
            'length'    => 255,
            'after'     => null,
            'comment'   => 'Custom payment amount'
        ]
    );

$installer->endSetup();
