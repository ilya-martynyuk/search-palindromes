<?php

/**
 * Class Palindrome
 *
 * Is used for searching of palindromes inside the string
 */
class Palindrome
{
    /**
     * Contains all palindromes which were found in the string
     * Can contains whole raw string (if it is a palindrome)
     *
     * @var array
     */
    protected $palindromes = [];

    /**
     * Original string
     *
     * @var string
     */
    protected $rawString;

    /**
     * Original string devided by characters
     *
     * @var array
     */
    protected $chars = [];

    /**
     * String to be checked for containing of palindrome
     *
     * @param $rawString
     */
    public function __construct($rawString)
    {
        $this->rawString = $rawString;

        $this->explodeByChars();
        $this->process();
    }

    /**
     * Converts string to an array (with cyrillic symbols support)
     */
    protected function explodeByChars()
    {
        preg_match_all('/./su', $this->rawString, $chars);
        $this->chars = $chars[0];
    }

    /**
     * Divides string into chunks (all possible combinations),
     * and checks them for containing of palindromes
     */
    protected function process()
    {
        $strLen = count($this->chars);

        // Length of current chunk of string
        $chunkLen = $strLen;

        // Loop through all possible chunks in the string.
        for ($chunkLen; $chunkLen > 1; $chunkLen--) {
            // Loop through all possible positions of chunk in the string.
            for ($startFrom = 0; $startFrom + $chunkLen <= $strLen; $startFrom++) {
                $chunkChars = array_slice($this->chars, $startFrom, $chunkLen);

                if ($this->isPalindrome($chunkChars)) {
                    $this->palindromes[] = trim(implode('', $chunkChars), ' ');
                }
            }
        }
    }

    /**
     * Checks whether an array of chars is a palindrome
     *
     * @param array $chunk Chunk represented as array of chars
     * @return bool Result of checking
     */
    protected function isPalindrome(array $chunk)
    {
        $chunk = array_map('mb_strtolower', $chunk);

        // Removes unnecessary characters from diff calculation
        $chunk = array_values(array_filter($chunk, function($val){
            return $val !== ' ';
        }));

        if (count($chunk) === 1) {
            return false;
        }

        $reversed = array_reverse($chunk);

        return count(array_diff_assoc($reversed, $chunk)) === 0;
    }

    /**
     * Returns longest palindrome which was found in the string
     *
     * @return string
     */
    protected function getLongestPalindrome()
    {
        return array_reduce($this->palindromes, function ($a, $b) {
            return strlen($a) > strlen($b) ? $a : $b;
        });
    }

    /**
     * Display algorithm
     *
     * @return string
     */
    public function __toString()
    {
        if (count($this->palindromes) === 0) {
            return $this->chars[0];
        }

        return $this->getLongestPalindrome();
    }
}
