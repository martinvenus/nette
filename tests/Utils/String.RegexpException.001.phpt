<?php

/**
 * Test: Nette\String and RegexpException run-time error.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */

use Nette\String;



require __DIR__ . '/../bootstrap.php';



ini_set('pcre.backtrack_limit', 3); // forces PREG_BACKTRACK_LIMIT_ERROR

try {
	String::split('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'Nette\RegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	String::match('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'Nette\RegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	String::matchAll('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'Nette\RegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	String::replace('0123456789', '#.*\d#', 'x');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'Nette\RegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

function cb() { return 'x'; }

try {
	String::replace('0123456789', '#.*\d#', callback('cb'));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'Nette\RegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}
