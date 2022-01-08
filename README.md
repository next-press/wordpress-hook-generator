# WordPress Hooks & Filters Parser

This is a handy wrapper around [wordpress-hook-parser](https://github.com/bologer/WordPress-Hook-Parser) to fix some dependencies and make the code available as a CLI tool that we can use on projects.

It parses the folders passed to it and generates a markdown file containing all the hooks, filters, with the corresponding documentation.

To see an example of the generated markdown file, [click here](https://github.com/next-press/wordpress-hook-generator/blob/main/examples/actions.md).

## Installation

As a CLI tool, this should be installed globally using composer.

To install it, simply run:

```
composer require next-press/wordpress-hook-generator
```

## Usage

After installing it globally, the CLI command `wordpress-hook-generator` becomes available system-wide.

Then you simply run it passing the target folder as the first argument.

```
wordpress-hook-generator path/to/folder
```

### Options

In addition to the path to be scanned, there are additional options that can be passed to the command.

#### Output file `-o`

By default, the output is written to a file called `actions.md` inside the directory where the command was ran.

You can override the output file name by passing a file path with the option `-o`.

```
wordpress-hook-generator path/to/folder -o custom-output-file-name.md
```

#### Ignore folders `-i`

By default, the vendor folder is ignored when scanning the target directory. If you wish to pass additional folder names to ignore, you can do so by using the `-i` option.

The `-i` option takes a comma-separated list of directory names.

```
wordpress-hook-generator path/to/folder -i dependencies,release
```

#### Enable debugging `-d`

By default, PHP warnings thrown while generating the documentation are suppressed and not shown on the terminal window. Adding the `-d` flag will display the warning messages.

## Development

To develop, test, or debug this tool, clone this repository and then be sure to first install both the PHP and node.js dependencies.

Clone the repository:

```
git clone https://github.com/next-press/wordpress-hook-generator
cd wordpress-hook-generator
```

Then for PHP, install the composer dependencies.

```
composer install
```

Do the same for node.js with npm.

```
npm install
```

### Important: Versioning

To bump the version number, run the command bellow on the root directory. This command is a shorthand for the `npm version` command and by default it bumps the version patch number (from 0.0.1 to 0.0.2, for example).

```
composer bump
```

If you need to bump the major or minor version numbers, use the full command below:

For a minor release:

```
npm --no-git-tag-version version minor
```

And for a major release:

```
npm --no-git-tag-version version major
```

There is no need to manually update the @version tags on the code, as a `pre-commit` is run by Husky to sync the version numbers, making sure they are always automatically up-to-date.

## Changelog

Version 0.0.2 - Released on 2021-01-08

* Improvement: Add composer.json to the sync-version-number file list;

Version 0.0.1 - Initial Release - Released on 2021-01-08

* Initial Release;