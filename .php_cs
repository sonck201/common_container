#!/usr/bin/php

<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => false,
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'phpdoc_align' => false,
        'phpdoc_annotation_without_dot' => false,
        'yoda_style' => false,
    ])
    ->setFinder($finder);

