<?php

class Custom_Paymentmethod_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract
{
    protected $_code  = 'paymentmethod';
    protected $_formBlockType = 'paymentmethod/form_paymentmethod';
    protected $_infoBlockType = 'paymentmethod/info_paymentmethod';

    public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        if ($data->getCstmPaymentamnt()) {
            $info->setCstmPaymentamnt($data->getCstmPaymentamnt());
        }

        return $this;
    }

    public function validate()
    {
        parent::validate();
        $info = $this->getInfoInstance();
        if (!$info->getCstmPaymentamnt()) {
            $errorCode = 'invalid';
            $errorMsg = $this->_getHelper()->__("Payment amount is required.");
        }

        if ($errorMsg) {
            Mage::throwException($errorMsg);
        }

        return $this;
    }
}
