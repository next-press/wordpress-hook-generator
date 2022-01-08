### good_static_filter
This is a well documented filter.
```php
apply_filters("good_static_filter", array $mce_translation, string $mce_locale)
```

Location: filters.php:13
#### Arguments
* `$mce_translation` (_array_) Key/value pairs of strings.
* `$mce_locale` (_string_) Locale.
### good_dynamic_filter_{$option}
This is a well documented dynamic filter.
```php
apply_filters("good_dynamic_filter_{$option}", mixed $value, mixed $old_value)
```

Location: filters.php:26
#### Arguments
* `$value` (_mixed_) The new, unserialized option value.
* `$old_value` (_mixed_) The old option value.
### good_double_quotes_dynamic_filter_{$option}
This is a well documented dynamic filter.
```php
apply_filters("good_double_quotes_dynamic_filter_{$option}", mixed $value, mixed $old_value)
```

Location: filters.php:39
#### Arguments
* `$value` (_mixed_) The new, unserialized option value.
* `$old_value` (_mixed_) The old option value.
### missing_since_static_filter
This is a filter missing the "since" line.
```php
apply_filters("missing_since_static_filter", mixed $value, string $mce_locale)
```

Location: filters.php:50
#### Arguments
* `$value` (_mixed_) The new, unserialized option value.
* `$mce_locale` (_string_) Locale.
### missing_since_dynamic_filter_{$option}
This is a dynamic filter missing the "since" line.
```php
apply_filters("missing_since_dynamic_filter_{$option}", mixed $value, mixed $old_value)
```

Location: filters.php:61
#### Arguments
* `$value` (_mixed_) The new, unserialized option value.
* `$old_value` (_mixed_) The old option value.
### missing_since_double_quotes_dynamic_filter_{$option}
This is a dynamic filter missing the "since" line.
```php
apply_filters("missing_since_double_quotes_dynamic_filter_{$option}", mixed $value, mixed $old_value)
```

Location: filters.php:72
#### Arguments
* `$value` (_mixed_) The new, unserialized option value.
* `$old_value` (_mixed_) The old option value.
### missing_param_static_filter
This is a filter missing one "param" line.
```php
apply_filters("missing_param_static_filter", string $mce_locale)
```

Location: filters.php:84
#### Arguments
* `$mce_locale` (_string_) Locale.
### missing_param_dynamic_filter_{$option}
This is a dynamic filter missing one "param" line.
```php
apply_filters("missing_param_dynamic_filter_{$option}", string $mce_locale)
```

Location: filters.php:96
#### Arguments
* `$mce_locale` (_string_) Locale.
### missing_param_double_quotes_dynamic_filter_{$option}
This is a dynamic filter missing one "param" line.
```php
apply_filters("missing_param_double_quotes_dynamic_filter_{$option}", string $mce_locale)
```

Location: filters.php:108
#### Arguments
* `$mce_locale` (_string_) Locale.
### multiple_since_tags
This is a filter with multiple since tags
```php
apply_filters("multiple_since_tags", string $first_parameter, string $second_parameter)
```

Location: filters.php:122
#### Arguments
* `$first_parameter` (_string_) 
* `$second_parameter` (_string_) 
### no_doc_static_filter

```php
apply_filters("no_doc_static_filter")
```

Location: filters.php:124
### no_doc_dynamic_filter_{$option}

```php
apply_filters("no_doc_dynamic_filter_{$option}")
```

Location: filters.php:126
### no_doc_double_quotes_dynamic_filter_{$option}

```php
apply_filters("no_doc_double_quotes_dynamic_filter_{$option}")
```

Location: filters.php:128
### good_doc_static_action
This is a well documented action.
```php
do_action("good_doc_static_action", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:15
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### good_doc_dynamic_action_{$option}
This is a well documented dynamic action.
```php
do_action("good_doc_dynamic_action_{$option}", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:29
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### good_doc_double_quotes_dynamic_action_{$option}
This is a well documented dynamic action.
```php
do_action("good_doc_double_quotes_dynamic_action_{$option}", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:43
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### missing_since_static_action
This is an action missing the "since" line.
```php
do_action("missing_since_static_action", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:55
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### missing_since_dynamic_action_{$option}
This is a dynamic action missing the "since" line.
```php
do_action("missing_since_dynamic_action_{$option}", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:67
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### missing_since_double_quotes_dynamic_action_{$option}
This is a dynamic action missing the "since" line.
```php
do_action("missing_since_double_quotes_dynamic_action_{$option}", string $option, mixed $old_value, mixed $value)
```

Location: actions.php:79
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$old_value` (_mixed_) The old option value.
* `$value` (_mixed_) The new option value.
### missing_param_static_action
This is an action missing a "param" line.
```php
do_action("missing_param_static_action", string $option, mixed $value)
```

Location: actions.php:92
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$value` (_mixed_) The new option value.
### missing_param_dynamic_action_{$option}
This is a well documented dynamic action.
```php
do_action("missing_param_dynamic_action_{$option}", string $option, mixed $value)
```

Location: actions.php:105
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$value` (_mixed_) The new option value.
### missing_param_double_quotes_dynamic_action_{$option}
This is a well documented dynamic action.
```php
do_action("missing_param_double_quotes_dynamic_action_{$option}", string $option, mixed $value)
```

Location: actions.php:118
#### Arguments
* `$option` (_string_) Name of the option to update.
* `$value` (_mixed_) The new option value.
### no_doc_static_action

```php
do_action("no_doc_static_action")
```

Location: actions.php:120
### no_doc_dynamic_action_{$option}

```php
do_action("no_doc_dynamic_action_{$option}")
```

Location: actions.php:121
### no_doc_double_quotes_dymanic_action_{$option}

```php
do_action("no_doc_double_quotes_dymanic_action_{$option}")
```

Location: actions.php:122
### deprecated_filter
This filter should be marked as deprecated since 1.0
```php
apply_filters("deprecated_filter")
```

Location: deprecated-file.php:23
### deprecated_action
This action should be marked as deprecated since 1.0
```php
do_action("deprecated_action")
```

Location: deprecated-file.php:28
