# Automad Automath Extension

This extension enables you to display beautiful mathematical notations within your pages by using the KaTeX math typesetting library.

![The Legendre symbol: teaser image of the extension](https://github.com/antstei/automad-automath/blob/master/images/teaser_image.png?raw=true)

## Usage

This extension can be enabled on pages by calling

	<@ Antstei/Automath { options } @>

inside the head section (`<head> ... </head>`) of the respective template. By putting inside [automad's blocks](https://automad.org/developer-guide/building-themes/template-language/variables#blocks) [by KaTeX supported TeX functions](https://katex.org/docs/supported.html) between two `$` pairs, such as

	$\bigl(\frac{a}{p}\bigr)$,

mathematical notations are rendered on page load by the user's web browser:

![The Legendre symbol: example usage image of the extension](https://github.com/antstei/automad-automath/blob/master/images/example_usage_image.png?raw=true)

## Options

The following options are available:

| Name | Default value |
|------|---------------|
| `source` | `'cdn'` |
| `defer` | `false` |
| [`element`](https://katex.org/docs/autorender.html#api) | `'document.body'` |
| [`delimiters](https://katex.org/docs/autorender.html#api) | `{"left": "$", "right": "$", "display": false}]'}` |
| [`ignoredTags`](https://katex.org/docs/autorender.html#api) | `["script", "noscript", "style", "textarea", "pre", "code"]` |
| [`ignoredClasses`](https://katex.org/docs/autorender.html#api) | not set |
| [`errorCallback`](https://katex.org/docs/autorender.html#api) | `(math: string) => string` |
