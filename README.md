# Automad Automath Extension

This extension enables you to display beautiful mathematical notations within your pages by using the [KaTeX math typesetting library](https://katex.org/).

![](https://raw.githubusercontent.com/antstei/automad-automath/master/images/teaser_image.png)

## Usage

This extension can be enabled on pages by calling

    <@ Antstei/Automath { options } @>

inside the head section (`<head> ... </head>`) of the respective template. By putting inside [automad's blocks](https://automad.org/developer-guide/building-themes/template-language/variables#blocks) by KaTeX [supported TeX functions](https://katex.org/docs/supported.html) between two pairs of dollar signs (`$` ... `$`), such as

    $\bigl(\frac{a}{p}\bigr)$

mathematical notations are rendered on page load by the user's web browser:

![The Legendre symbol: example usage image of the extension](https://github.com/antstei/automad-automath/blob/master/images/example_usage_image.png?raw=true)

## Options

The following options are available:

| Name | Default value |
|------|---------------|
| `source` | `'cdn'` |
| `defer` | `false` |
| [`element`](https://katex.org/docs/autorender.html#api) | `'document.body'` |
| [`delimiters`](https://katex.org/docs/autorender.html#api) | `[{"left": "$", "right": "$", "display": false}]` |
| [`ignoredTags`](https://katex.org/docs/autorender.html#api) | *By default not set*, hence KaTeX default value `["script", "noscript", "style", "textarea", "pre", "code"]` is used. |
| [`ignoredClasses`](https://katex.org/docs/autorender.html#api) | *By default not set*. |
| [`errorCallback`](https://katex.org/docs/autorender.html#api) | *By default not set*. |
