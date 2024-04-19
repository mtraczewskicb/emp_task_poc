<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('.docker')
    ->exclude('.github')
    ->exclude('bin')
    ->exclude('gen')
    ->exclude('migrations')
    ->exclude('templates')
    ->exclude('var')
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'increment_style' => [
            'style' => 'post',
        ],
        'global_namespace_import' => [
            'import_classes' => true,
        ],
        'phpdoc_separation' => [
            'groups' => [
                ['Serializer\\*', 'Assert\\*', 'EntityExists'],
                ['ORM\\*'],
                ['covers', 'group'],
            ]
        ],
    ])
    ->setFinder($finder)
    ->setLineEnding("\n");
