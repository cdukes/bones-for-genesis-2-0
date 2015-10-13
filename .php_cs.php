<?php

// See https://github.com/FriendsOfPHP/PHP-CS-Fixer for options

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('bower_components')
    ->exclude('node_modules')
    ->exclude('vendor')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->fixers(
	    array(
		    '-indentation',
		    '-braces',
		    '-parenthesis',
		    '-function_declaration',
		    '-concat_without_spaces',

		    'align_double_arrow',
		    'align_equals',
		    'concat_with_spaces',
		    'ereg_to_preg',
		    'header_comment',
		    'long_array_syntax',
		    'multiline_spaces_before_semicolon',
		    'newline_after_open_tag',
		    'no_blank_lines_before_namespace',
		    'ordered_use',
		    'php4_constructor',
		    'php_unit_construct',
		    'php_unit_strict',
		    'phpdoc_order',
		    'phpdoc_var_to_type',
			'short_echo_tag',
		    'strict',
		    'strict_param'
		)
	)
    ->finder($finder)
;