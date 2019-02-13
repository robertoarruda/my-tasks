<?php

include_once 'CreditCard.php';

class CreditCardTest extends PHPUnit_Framework_TestCase
{

    public function testValidNumber()
    {
        $creditCard = new CreditCard();
        $this->assertTrue($creditCard->Set('4444333322221111'));
    }

    public function testInvalidNumberShouldReturError()
    {
        $creditCard = new CreditCard();
        $this->assertEquals('ERROR_INVALID_LENGTH', $creditCard->Set('3333555522221111'));
    }

    public function testValidNumberShouldSetAndGet()
    {
        $creditCard = new CreditCard();
        $creditCard->Set('4444333322221111');
        $this->assertEquals('4444333322221111', $creditCard->Get());
    }
}
