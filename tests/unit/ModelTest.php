<?php

namespace yiiunit\extensions\phonevalidator;

use mikk150\phonevalidator\PhoneNumberValidator;
use libphonenumber\PhoneNumberFormat;
use \yiiunit\extensions\phonevalidator\data\models\NumberModel;
use \yiiunit\extensions\phonevalidator\data\models\CountryNumberModel;
use yiiunit\extensions\phonevalidator\data\models\NumberTypeModel;
use libphonenumber\PhoneNumberType;

/**
*
*/
class ModelTest extends TestCase
{
    
    public function testInternationalModel()
    {
        $model = new NumberModel([
            'phone' => $this->phoneNumberUtil->format($this->getPhoneNumber('US'), PhoneNumberFormat::INTERNATIONAL),
        ]);
        $this->assertTrue($model->validate());
    }
    public function testNationalModel()
    {
        $model = new NumberModel([
            'phone' => $this->phoneNumberUtil->format($this->getPhoneNumber('US'), PhoneNumberFormat::NATIONAL),
        ]);
        $this->assertTrue($model->validate());
    }

    public function testWrongPhoneNumber()
    {
        $model = new NumberModel([
            'phone' => '+00 0000 0000'
        ]);
        $this->assertFalse($model->validate());
    }

    public function testRightNumberType()
    {
        $model = new NumberTypeModel([
            'phone' =>  $this->phoneNumberUtil->format($this->getPhonenumberForType('AR', PhoneNumberType::MOBILE), PhoneNumberFormat::INTERNATIONAL)
        ]);
        $this->assertTrue($model->validate());
    }

    public function testWrongNumberType()
    {
        $model = new NumberTypeModel([
            'phone' =>  $this->phoneNumberUtil->format($this->getPhonenumberForType('AR', PhoneNumberType::FIXED_LINE), PhoneNumberFormat::INTERNATIONAL)
        ]);
        $this->assertFalse($model->validate());
    }

    public function testCountryModel()
    {
        $model = new CountryNumberModel([
            'phone' => $this->phoneNumberUtil->format($this->getPhoneNumber('US'), PhoneNumberFormat::INTERNATIONAL),
            'country' => 'US'
        ]);
        $this->assertTrue($model->validate());
    }

    public function testEmptyPhone()
    {
        $model = new NumberModel([
            'phone' => ''
        ]);
        $this->assertTrue($model->validate());
    }
}
