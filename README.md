# WordPress Hooks & Filters Parser

This is a handy wrapper around [wordpress-hook-parser](https://github.com/bologer/WordPress-Hook-Parser) to fix some dependencies and make the code available as a CLI tool that we can use on projects.

It parses the folders passed to it and generates a markdown file containing all the hooks, filters, with the corresponding documentation.

To see an example of the generated markdown file, [click here](https://github.com/next-press/wordpress-hook-generator/blob/main/actions.md).

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
