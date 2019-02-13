<?php

class CreditCard
{
    const ERROR_INVALID_CHAR = 'ERROR_INVALID_CHAR';

    const ERROR_INVALID_LENGTH = 'ERROR_INVALID_LENGTH';

    const ERROR_NOT_SET = 'ERROR_NOT_SET';

    protected $number;

    protected $error;

    public function __call($name, $arguments)
    {
        if ($name == '_check_length') {
            return call_user_func([$this, 'checkLength'], ...$arguments);
        }

        return call_user_func([$this, lcfirst($name)], ...$arguments);
    }

    protected function checkLength($length, $category)
    {
        if (in_array($category, [0, 1, 2, 3, 4])) {
            return call_user_func([$this, "checkLengthCategory{$category}"], $length);
        }

        return 1;
    }

    private function checkLengthCategory0($length)
    {
        return in_array($length, [13, 16]);
    }

    private function checkLengthCategory1($length)
    {
        return in_array($length, [16, 18, 19]);
    }

    private function checkLengthCategory2($length)
    {
        return ($length == 16);
    }

    private function checkLengthCategory3($length)
    {
        return ($length == 15);
    }

    private function checkLengthCategory4($length)
    {
        return ($length == 14);
    }

    public function isValid($number = null)
    {
        if (is_null($number)) {
            $this->error = self::ERROR_INVALID_CHAR;

            return $this->error;
        }

        $this->clearValues();

        if (empty($number = $this->extractCardNumber($number))) {
            $this->error = self::ERROR_INVALID_CHAR;
            return $this->error;
        }

        if (!$this->checkLength(strlen($number), $this->category($number[0]))) {
            $this->error = self::ERROR_INVALID_LENGTH;
            return $this->error;
        }

        $this->number = $number;

        return true;
    }

    private function clearValues()
    {
        $this->number = null;
        $this->error = self::ERROR_NOT_SET;
    }

    private function extractCardNumber($number)
    {
        $cardNumber = '';
        for ($index = 0; $index < strlen($number); $index++) {
            $character = $number[$index];

            if (!ctype_digit($character) && !ctype_space($character) && !ctype_punct($character)) {
                return '';
            }

            if (!ctype_digit($character)) {
                continue;
            }

            $cardNumber .= $character;
        }

        return $cardNumber;
    }

    private function category($firstNumber)
    {
        if ($firstNumber == '4' || $firstNumber == '5') {
            return 2;
        }

        if ($firstNumber == '3') {
            return 4;
        }

        if ($firstNumber == '2') {
            return 3;
        }

        return 0;
    }

    public function set($number = null)
    {
        if (is_null($number)) {
            $this->clearValues();

            return $this->error;
        }

        return $this->isValid($number);
    }

    /**
     * Retrieve the current card number. the number is returned
     * unformatted suitable for use with submission to payment and
     * authorization gateways
     *
     * @return card number
     */
    public function get()
    {
        return $this->number ?? null;
    }

}
