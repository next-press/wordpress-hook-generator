<?php
/**
 * Webhook Hook Generator
 *
 * @package NextPress
 */

namespace NextPress;

use \Colors\Color;
use \Commando\Command;

/**
 * Main command class
 *
 * Nicely wrapper the command inside a class.
 *
 * @since 0.0.1
 * @package NextPress
 */
class Hook_Generator {

	/**
	 * Keeps the version of the command.
	 *
	 * @var string
	 */
	public static $version = '0.0.7';

	/**
	 * Generates the output file.
	 *
	 * @since 0.0.1
	 * @return void
	 */
	public static function run() {

		$cmd = new Command();

		$cmd
		->setHelp('Scan a directory for WordPress hooks and Filters.  It can be used by calling `wordpress-hook-generator <argument> <options>`.')
		->beepOnError();

		$cmd->option()
		->aka('path')
		->default('./')
		->describedAs('Path to scan.');

		$cmd->option('o')
		->aka('output')
		->aka('out')
		->default('actions.md')
		->describedAs('Output file.');

		$cmd->option('i')
		->aka('ignore')
		->aka('cap')
		->default('vendor,dependencies')
		->describedAs('Folders to ignore');

		$cmd->option('h')
		->aka('help')
		->boolean()
		->describedAs('Display the help text for the command');

		$cmd->option('d')
		->aka('debug')
		->boolean()
		->describedAs('If we should display errors or not');

		$cmd->option('sync-version')
		->boolean()
		->describedAs('Internal! Sync the version number between the package.json and the php file.');

		$cmd->option('u')
		->aka('update')
		->boolean()
		->describedAs('Update this generator.');

		$c = new Color();

		/*
		 * Disable notices outputs.
		 */
		error_reporting(0);

    /*
     * When the help flag is present, display it and bail.
     */
		if ($cmd['help']) {

			$cmd->printHelp();

			exit;

		} // end if;

    /*
     * Deal with the updates.
     */
		if ($cmd['update']) {

			self::_update();

			exit;

		} // end if;

    /*
     * Print the Header to the CLI.
     */
		$text = <<<EOF

    WordPress Hook Generator

    <dark>→ Version: <italic>%s</italic></dark>
    <dark>→ Target Directory: <italic>%s</italic></dark>
    <dark>→ Output File: <italic>%s</italic></dark>
    <dark>→ Ignore List: <italic>%s</italic></dark>


    <italic>→ Starting Scan...</italic>
    EOF; // phpcs:ignore

		$ignore_dirs = explode(',', $cmd['ignore']);

		$ignore_dirs = array_map(function($item) {

			return trim($item);

		}, $ignore_dirs);

		$ignore_dirs = array_filter($ignore_dirs);

		$target_dir = $cmd[0] === './' ? 'current directory' : $cmd[0];

		$ignore_dirs_text = !empty($ignore_dirs) ? implode(', ', $ignore_dirs) : 'None';

		$text = sprintf($text, self::$version, $target_dir, $cmd['output'], $ignore_dirs_text);

		echo $c($text)->colorize() . PHP_EOL;

		try {

			$f = fopen($cmd['output'], 'wb');

			fclose($f);

			// ob_start(); // Removed for now.

			$hooks_parser = new \Bologer\HooksParser(array(
				'scanDirectory'     => $cmd[0],
				'ignoreDirectories' => $ignore_dirs,
			));

			$parsed_items = $hooks_parser->parse();

			$hooks_documentation = new Hook_Documentation($parsed_items);

			$hooks_documentation->setSaveLocation($cmd['output']);

			$status = $hooks_documentation->write();

			if ($status === false) {

				throw new \Exception('A fatal error was found.');

			} // end if;

			$errors = ob_get_contents();

			ob_end_clean();

			$errors = explode('Parse Error: ', $errors);

			$errors = array_filter($errors);

			if (empty($errors)) {

				echo PHP_EOL . $c('<italic><green>→ Document generated successfully!</green></italic>')->colorize() . PHP_EOL;

			} elseif (!empty($errors) && $cmd['debug']) {

				echo PHP_EOL . $c('<italic>→ Warnings List:</italic>')->colorize() . PHP_EOL . PHP_EOL;

				foreach ($errors as $error) {

					echo $c('<yellow>|→ <italic>' . $error . '</italic></yellow>')->colorize() . PHP_EOL;

				} // end foreach;

				echo PHP_EOL . $c('<italic><green>→ Document generated successfully (with warnings)!</green></italic>')->colorize() . PHP_EOL;

			} elseif (!empty($errors) && !$cmd['debug']) {

				echo $c('<italic><green>→ Document generated successfully (with warnings)!</green></italic>')->colorize() . PHP_EOL;

			} // end if;

			echo PHP_EOL;

		} catch (\Throwable $th) {

			$error = sprintf('<italic><red>→ Error: %s</red></italic>', $th->getMessage());

			echo $c($error)->colorize() . PHP_EOL;

			exit(1);

		} // end try;

		exit(0);

	} // end run;

	/**
	 * Sync the version number between the package.json and this file.
	 *
	 * Ok, I agree this is not the ideal way of doing this, but since we
	 * already have a cli tool context to use, I can't see why not do it
	 * this way. We might revisit this later, of course.
	 *
	 * @internal
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public static function _sync_version() {

		$pwd = dirname(__FILE__, 2); // phpcs:ignore

		$files = array(
			__FILE__,
			$pwd . '/composer.json',
			$pwd . '/bin/wordpress-hook-generator',
		);

		$json = json_decode(file_get_contents($pwd . '/package.json'), true);

		foreach ($files as $file) {

			$content = file_get_contents($file);

			$content = preg_replace_callback('/(?:"version|@version|\$version)(?:[\s\'"=:]+)((?:\d+\.)?(?:\d+\.)?(?:\*|\d+))(?:[\s\'";]+)/', function($matches) use ($json) {

				$new_content = str_replace($matches[1], $json['version'], $matches[0]);

				return $new_content;

			}, $content);

			echo sprintf('→ Updating version number to %s in %s...', $json['version'], $file) . PHP_EOL;

			file_put_contents($file, $content);

		} // end foreach;

		echo '→ Done!' . PHP_EOL;

	} // end _sync_version;

	/**
	 * Update the tool version via Git.
	 *
	 * @internal
	 * @since 0.0.7
	 *
	 * @return void
	 */
	public static function _update() {

		$pwd = dirname(__FILE__, 2); // phpcs:ignore

		echo sprintf('→ Updating tool...') . PHP_EOL;

		$commands = sprintf('
			cd "%s"
			git remote update
			git status -uno | grep -q -v "Your branch is up to date with \'origin/main\'" || composer install --quiet 
		', $pwd);

		$output = shell_exec($commands);

		$output = explode(PHP_EOL, $output);

		$output = array_filter($output);

		echo '→ ' . implode(PHP_EOL . '→ ', $output) . PHP_EOL;

		$json = json_decode(file_get_contents($pwd . '/package.json'), true);

		echo sprintf('→ Installed version: %s', $json['version']) . PHP_EOL;

		echo '→ Done!' . PHP_EOL;

	} // end _update;

} // end class Hook_Generator;
