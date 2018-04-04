<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symphony' => true,
        'array_syntax' => ['syntax' => 'short']],
        'no_usused_imports' => true,
    ]);
