<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isValidCardNumber($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.card_number');
    }

    /**
     * Validate the card number using the Luhn algorithm.
     *
     * @param  string  $number
     * @return bool
     */
    private function isValidCardNumber($number)
    {
        $number = preg_replace('/\D/', '', $number);
        $checksum = 0;
        $len = strlen($number);
        for ($i = $len - 1; $i >= 0; $i--) {
            $digit = $number[$i];
            if (($len - $i) % 2 == 0) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $checksum += $digit;
        }
        return $checksum % 10 === 0;
    }
}

?>
