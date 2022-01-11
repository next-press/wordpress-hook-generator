<?php
/**
 * Ignored tags.
 *
 * @package ignored
 */

/**
 * This hook should not be ignored.
 *
 * @since 5.4.0
 */
do_action('main_scope_do_not_ignore');

/**
 * This should be ignored and not included on the generated file.
 *
 * @ignore
 * @param mixed $param A mixed parameter.
 * @param bool $bool A boolean parameter.
 */
do_action('main_scope_ignored_hook', $param, $bool);

/**
 * This should be ignored and not included on the generated file.
 *
 * @ignore
 * @param mixed $old_value The old value.
 * @return mixed The new value.
 */
$main_scope_ignored_filter = apply_filters('main_scope_ignored_filter', $old_value);

function function_scope() {

	/**
   * This should be ignored and not included on the generated file.
   *
   * @ignore
   * @param mixed $param A mixed parameter.
   * @param bool $bool A boolean parameter.
   */
	do_action('function_scope_ignored_hook', $param, $bool);

	/**
	 * This should be ignored and not included on the generated file.
	 *
	 * @ignore
	 * @param mixed $old_value The old value.
	 * @return mixed The new value.
	 */
	$function_scope_ignored_filter = apply_filters('function_scope_ignored_filter', $old_value);

} // end function_scope;

/**
 * Test Class to check class-method scoped filters and hooks.
 */
class Class_Scope {

	public function method_scope() {

		/**
		 * This should be ignored and not included on the generated file.
		 *
		 * @ignore
		 * @param mixed $param A mixed parameter.
		 * @param bool $bool A boolean parameter.
		 */
		do_action('method_scope_ignored_hook', $param, $bool);

		/**
		 * This should be ignored and not included on the generated file.
		 *
		 * @ignore
		 * @param mixed $old_value The old value.
		 * @return mixed The new value.
		 */
		$method_scope_ignored_filter = apply_filters('method_scope_ignored_filter', $old_value);

	} // end method_scope;

} // end class Class_Scope;
