<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('bower_components')
    ->exclude('node_modules')
    ->exclude('vendor')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
	->level(Symfony\CS\FixerInterface::CONTRIB_LEVEL)
    ->fixers(array('-indentation', '-braces', '-parenthesis', '-function_declaration'))
    ->finder($finder)
;
