<?php
/**
 * Hook documentation template.
 *
 * @package NextPress
 */

namespace NextPress;

/**
 * Main command class
 *
 * Nicely wrapper the command inside a class.
 *
 * @since 0.0.1
 * @package NextPress
 */
class Hook_Documentation extends \Bologer\HookDocumentation {


	/**
	 * Generates hook function.
	 *
	 * @param HookDto $hook The hooks.
	 *
	 * @return string
	 */
	protected function generateFunction($hook) {

		// Function execution
		$function = '';

		switch ($hook->type) {

			case 'filter':
				$function = 'apply_filters(';
				break;
			case 'filter_deprecated':
				$function = 'apply_filters(';
				break;
			case 'action':
				$function = 'do_action(';
				break;
			case 'action_deprecated':
				$function = 'do_action(';
				break;

		} // end switch;

		$function .= sprintf('"%s"', $hook->name);

		if (empty($hook->docBlock->tags)) { // phpcs:ignore

			$function .= ')';

		} else {

			foreach ($hook->docBlock->tags as $tag) { // phpcs:ignore

				if (empty($tag->variable)) {

					continue;

				} // end if;

				if (empty($tag->types)) {
					$function .= ', ' . $tag->variable;

				} else {

					$function .= ', ' . implode( '|', $tag->types ) . ' ' . $tag->variable;

				} // end if;

			} // end foreach;

			$function .= ')';

		} // end if;

		return $function;

	} // end generateFunction;

	/**
	 * Get the value of a tag.
	 *
	 * @param object      $hook The hook object.
	 * @param string      $tag_name The tag value, such as 'see', 'return'.
	 * @param null|string $tag_value The tag value to return or the object, if null is passed.
	 * @param mixed       $default The default value.
	 * @return mixed
	 */
	protected function get_tag($hook, $tag_name, $tag_value = 'content', $default = false) {

		$value = $default;

		foreach ($hook->docBlock->tags as $tag) { // phpcs:ignore

			if ($tag->name === $tag_name) {

				if ($tag_value == null) {

					$value = $tag;

				} else {

					$value = $tag->{$tag_value};

				} // end if;

				break;

			} // end if;

		} // end foreach;

		return $value;

	} // end get_tag;

	/**
	 * Get the deprecated values.
	 *
	 * @param object $hook The hook.
	 * @return string
	 */
	protected function get_deprecation($hook) {

		$message = '';

		$version = false;

		if ($hook->type === 'filter_deprecated' || $hook->type === 'action_deprecated') {

			$version     = $hook->arguments[1] ?? ''; // phpcs:ignore
			$replacement = $hook->arguments[2] ?? ''; // phpcs:ignore
			$message     = $hook->arguments[3] ?? ''; // phpcs:ignore

			$version = trim($version, '"\'');

			if ($message) {

				$message = ' - ' . trim($message, '"\'');

			} // end if;

			$desc = $replacement ? "Use $replacement instead." : '';

		} else {

			$version = $this->get_tag($hook, 'deprecated');
			$desc    = $this->get_tag($hook, 'deprecated', 'description', 'No description provided.');

		} // end if;

		if ($version) {

			return sprintf('Deprecated in %s *%s*%s', $version, $desc, $message);

		} // end if;

		return false;

	} // end get_deprecation;

	// phpcs:disable

	/**
	 * Generates single hook.
	 *
	 * @param \Bologer\HookDto $hook The hook data.
	 * @return void
	 *
	 */
	protected function generateSingleHook($hook) {

		/**
		 * Skip ignored hooks.
		 */
		if ($this->get_tag($hook, 'ignore', 'content', null) !== null) {

			return;

		} // end if;

		$header = '---' . PHP_EOL;

		$content = $this->_markdownContent;

		if (!$content) {

			$header = '';

		} // end if;

		// Title & Description
		$title            = $hook->name;
		$description      = $hook->docBlock->description ?: '*No description provided.*';
		$long_description = $hook->docBlock->longDescription;
		$since            = $this->get_tag($hook, 'since');
		$see              = $this->get_tag($hook, 'see');

		$content .= $header;
		$content .= '### ' . $title . PHP_EOL;
		$content .= PHP_EOL . $description . PHP_EOL;

		if ($long_description) {

			$content .= PHP_EOL . strip_tags($long_description) . PHP_EOL;

		} // end if;

		$additional_items = array();

		if ($see) {

			$refers = $this->get_tag($hook, 'see', 'refers');

			$additional_items[] = sprintf('More Info: [%s](%s)', $see, $refers);

		} // end if;

		if ($since) {

			$additional_items[] = sprintf('Added in %s', $since);

		} // end if;

		$deprecated = $this->get_deprecation($hook);

		if ($deprecated) {

			$additional_items[] = $deprecated;

		} // end if;

		if ($additional_items) {

			$content .= PHP_EOL . implode(PHP_EOL, $additional_items) . PHP_EOL;

		} // end if;

		$function = $this->generateFunction($hook);

		$location = $hook->path . ':' . $hook->line;

		$content .= <<<EOT

```php
$function
```

Location: $location

EOT;

		if (!empty($hook->docBlock->tags)) {

			$empty = true;

			$content .= PHP_EOL . '#### Arguments' . PHP_EOL;
			
			foreach ($hook->docBlock->tags as $tag) {

				if ($tag->name === 'param') {

					$empty = false;

					$content .= sprintf('* `%s` (%s) %s',
						$tag->variable,
						'_' . implode( '_|_', $tag->types ) . '_',
						$tag->content
					) . PHP_EOL;

				} // end if;

			} // end foreach;

			if ($empty) {

				$content .= '*None.*' . PHP_EOL;

			} // end if;

		} // end if;

		$return = $this->get_tag($hook, 'return', null);

		if ($return) {

			$content .= PHP_EOL . '#### Expected Return' . PHP_EOL;

			$content .= sprintf('(%s) %s',
				'_' . implode('_|_', $tag->types) . '_',
				$tag->content ?: 'No description provided.'
			) . PHP_EOL;

		} // end if;

		$this->_markdownContent = $content . PHP_EOL;

	} // end generateSingleHook;

	// phpcs:enable

} // end class Hook_Documentation;
