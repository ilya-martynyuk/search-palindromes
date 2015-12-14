<?php

class PalindromeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider palindromeProvider
     */
    public function testPalindrome($input, $expected)
    {
        $this->assertEquals($expected, new Palindrome($input) . '');
    }

    public function palindromeProvider()
    {
        return [
            [
                'a', 'a'
            ],[
                'bb', 'bb'
            ], [
                'ala', 'ala'
            ], [
                'No palindromes', 'N'
            ], [
                'Аргентина манит негРа', 'Аргентина манит негРа'
            ], [
                'Sum summus mus', 'Sum summus mus'
            ], [
                'Test level', 'level'
            ]
        ];
    }
}