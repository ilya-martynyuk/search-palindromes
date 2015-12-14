<?php

require_once 'bootstrap.php';

// String is a fully palindrome
echo new Palindrome('Аргентина манит негра');
echo '<br>';
echo new Palindrome('Sum summus mus');
echo '<br>';

// String contains palindrome 'level'
echo new Palindrome('Test level');
echo '<br>';

// String doesn't contain palindromes
echo new Palindrome('No palindromes');
echo '<br>';