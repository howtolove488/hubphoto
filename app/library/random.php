<?php

namespace App\Libs;

class random {
	public static function generate($name) {
		$secret_string = 'lkdflkgdfgjlkdwieoirwqmasdnxnvjwnqwjejfoijwqoifsnxv,mxnvjknjsenqwefjwqio;;sdfsdfnkjasLKSNAKJy784jknkji4kjnkjgnkjnf33njfk3nj4nfk34kjnJKN23J2j32nankjfkqw2jn3jnkn74383dknkvsn83wu9tnsdnnkjankjsf83u489528YUGUYBJB98ufnkjanuywefhshv9x8yv9';
		$index_sub = rand(0, strlen($secret_string));
		$secret_key = $name.substr($secret_string, 0, $index_sub);
		return md5($secret_key);
	}
}