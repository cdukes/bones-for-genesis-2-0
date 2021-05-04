<?php

// See https://github.com/FriendsOfPHP/PHP-CS-Fixer for options

$finder = PhpCsFixer\Finder::create()
	->exclude('bower_components')
	->exclude('node_modules')
	->exclude('vendor')
	->in(__DIR__);

$config = new PhpCsFixer\Config();

return $config
	->setUsingCache(true)
	->setRiskyAllowed(true)
	->setIndent("\t")
	->setRules(
		array(
			// Alias
			'array_push'                       => true,
			'backtick_to_shell_exec'           => true,
			'ereg_to_preg'                     => true,
			'mb_str_functions'                 => true,
			'no_alias_functions'               => true,
			'no_alias_language_construct_call' => true,
			'no_mixed_echo_print'              => true,
			'pow_to_exponentiation'            => true,
			'random_api_migration'             => true,
			'set_type_to_cast'                 => true,

			// Array Notation
			'array_syntax'                                => array('syntax' => 'long'),
			'no_multiline_whitespace_around_double_arrow' => true,
			'no_trailing_comma_in_singleline_array'       => true,
			'no_whitespace_before_comma_in_array'         => true,
			'normalize_index_brace'                       => true,
			'trim_array_spaces'                           => true,
			'whitespace_after_comma_in_array'             => true,

			// Basic
			'braces'                  => false,
			'encoding'                => true,
			'non_printable_character' => true,
			'psr_autoloading'         => false,

			// Casing
			'constant_case'                           => true,
			'lowercase_keywords'                      => true,
			'lowercase_static_reference'              => true,
			'magic_constant_casing'                   => true,
			'magic_method_casing'                     => true,
			'magic_method_casing'                     => true,
			'native_function_type_declaration_casing' => true,

			// Cast Notation
			'cast_spaces'             => true,
			'lowercase_cast'          => true,
			'modernize_types_casting' => true,
			'no_short_bool_cast'      => true,
			'no_unset_cast'           => true,
			'short_scalar_cast'       => true,

			// Class Notation
			'class_attributes_separation'            => true,
			'class_definition'                       => false,
			'final_class'                            => false,
			'final_internal_class'                   => true,
			'final_public_method_for_abstract_class' => false,
			'no_blank_lines_after_class_opening'     => true,
			'no_null_property_initialization'        => true,
			'no_php4_constructor'                    => true,
			'no_unneeded_final_method'               => true,
			'ordered_class_elements'                 => false,
			'ordered_interfaces'                     => true,
			'ordered_traits'                         => true,
			'protected_to_private'                   => true,
			'self_accessor'                          => true,
			'self_static_accessor'                   => true,
			'single_class_element_per_statement'     => true,
			'single_trait_insert_per_statement'      => true,
			'visibility_required'                    => true,

			// Class Usage
			'date_time_immutable' => true,

			// Comment
			'header_comment'                    => false,
			'multiline_comment_opening_closing' => true,
			'no_empty_comment'                  => true,
			'no_trailing_whitespace_in_comment' => true,
			'single_line_comment_style'         => false,

			// Constant Notation
			'native_constant_invocation' => true,

			// Control Structure
			'elseif'                          => true,
			'include'                         => true,
			'no_alternative_syntax'           => true,
			'no_break_comment'                => true,
			'no_superfluous_elseif'           => true,
			'no_trailing_comma_in_list_call'  => true,
			'no_unneeded_control_parentheses' => true,
			'no_unneeded_curly_braces'        => true,
			'no_useless_else'                 => true,
			'simplified_if_return'            => true,
			'switch_case_semicolon_to_colon'  => true,
			'switch_case_space'               => true,
			'switch_continue_to_break'        => true,
			'trailing_comma_in_multiline'     => true,
			'yoda_style'                      => array('equal' => false, 'identical' => false),

			// Function Notation
			'combine_nested_dirname'                           => true,
			'fopen_flag_order'                                 => true,
			'fopen_flags'                                      => true,
			'function_declaration'                             => true,
			'function_typehint_space'                          => true,
			'implode_call'                                     => true,
			'lambda_not_used_import'                           => true,
			'method_argument_space'                            => array('on_multiline' => 'ignore'),
			'native_function_invocation'                       => array('scope' => 'namespaced'),
			'no_spaces_after_function_name'                    => true,
			'no_unreachable_default_argument_value'            => true,
			'no_useless_sprintf'                               => true,
			'nullable_type_declaration_for_default_null_value' => true,
			'regular_callable_call'                            => true,
			'return_type_declaration'                          => true,
			'single_line_throw'                                => true,
			'static_lambda'                                    => true,
			'use_arrow_functions'                              => false,
			'void_return'                                      => false,

			// Import
			'fully_qualified_strict_types' => true,
			'global_namespace_import'      => true,
			'group_import'                 => true,
			'no_leading_import_slash'      => true,
			'no_unused_imports'            => true,
			'ordered_imports'              => true,
			'single_import_per_statement'  => false,
			'single_line_after_imports'    => true,

			// Language Construct
			'class_keyword_remove'         => true,
			'combine_consecutive_issets'   => true,
			'combine_consecutive_unsets'   => false,
			'declare_equal_normalize'      => true,
			'dir_constant'                 => true,
			'error_suppression'            => false,
			'explicit_indirect_variable'   => true,
			'function_to_constant'         => true,
			'is_null'                      => true,
			'no_unset_on_property'         => true,
			'single_space_after_construct' => array('constructs' => array('abstract', 'as', 'attribute', 'break', 'case', 'catch', 'class', 'clone', 'comment', 'const', 'const_import', 'continue', 'do', 'echo', 'else', 'extends', 'final', 'finally', 'for', 'function', 'function_import', 'global', 'goto', 'implements', 'include', 'include_once', 'instanceof', 'insteadof', 'interface', 'match', 'named_argument', 'new', 'open_tag_with_echo', 'php_doc', 'php_open', 'print', 'private', 'protected', 'public', 'require', 'require_once', 'return', 'static', 'throw', 'trait', 'try', 'use', 'use_lambda', 'use_trait', 'var', 'yield', 'yield_from')),

			// List Notation
			'list_syntax' => array('syntax' => 'long'),

			// Namespace Notation
			'blank_line_after_namespace'         => true,
			'clean_namespace'                    => true,
			'no_blank_lines_before_namespace'    => false,
			'no_leading_namespace_whitespace'    => true,
			'single_blank_line_before_namespace' => true,

			// Naming
			'no_homoglyph_names' => true,

			// Operator
			'binary_operator_spaces'             => array('default' => 'align_single_space_minimal'),
			'concat_space'                       => array('spacing' => 'one'),
			'increment_style'                    => true,
			'logical_operators'                  => true,
			'new_with_braces'                    => true,
			'not_operator_with_space'            => false,
			'not_operator_with_successor_space'  => false,
			'object_operator_without_whitespace' => true,
			'operator_linebreak'                 => true,
			'standardize_increment'              => true,
			'standardize_not_equals'             => true,
			'ternary_operator_spaces'            => true,
			'ternary_to_elvis_operator'          => true,
			'ternary_to_null_coalescing'         => true,
			'unary_operator_spaces'              => true,

			// PHP Tag
			'blank_line_after_opening_tag' => true,
			'echo_tag_syntax'              => true,
			'full_opening_tag'             => true,
			'linebreak_after_opening_tag'  => true,
			'no_closing_tag'               => true,

			// Return Notation
			'no_useless_return'      => true,
			'return_assignment'      => true,
			'simplified_null_return' => true,

			// Semicolon
			'multiline_whitespace_before_semicolons'     => true,
			'no_empty_statement'                         => true,
			'no_singleline_whitespace_before_semicolons' => true,
			'semicolon_after_instruction'                => true,
			'space_after_semicolon'                      => true,

			// Strict
			'declare_strict_types' => false,
			'strict_comparison'    => true,
			'strict_param'         => true,

			// String Notation
			'escape_implicit_backslashes'       => true,
			'explicit_string_variable'          => true,
			'no_binary_string'                  => true,
			'no_trailing_whitespace_in_string'  => true,
			'simple_to_complex_string_variable' => true,
			'single_quote'                      => true,
			'string_line_ending'                => true,

			// Whitespace
			'array_indentation'            => true,
			'blank_line_before_statement'  => true,
			'compact_nullable_typehint'    => true,
			'indentation_type'             => true,
			'line_ending'                  => true,
			'method_chaining_indentation'  => true,
			'no_extra_blank_lines'         => true,
			'no_spaces_around_offset'      => true,
			'no_spaces_inside_parenthesis' => false,
			'no_trailing_whitespace'       => true,
			'no_whitespace_in_blank_line'  => true,
			'single_blank_line_at_eof'     => true,
		)
	)
	->setFinder($finder);
