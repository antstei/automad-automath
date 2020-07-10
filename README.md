# Automad Automath Extension

This extension enables you to display beautiful mathematical notations within your pages by using the [KaTeX math typesetting library](https://katex.org/).

![](https://raw.githubusercontent.com/antstei/automad-automath/master/images/teaser_image.png)

## Usage

This extension can be enabled on pages by calling

    <@ Antstei/Automath { options } @>

inside the head section (`<head> ... </head>`) of the respective template. By putting inside [Automad's blocks](https://automad.org/developer-guide/building-themes/template-language/variables#blocks) by KaTeX [supported TeX functions](https://katex.org/docs/supported.html) between two pairs of dollar signs (`$` ... `$`), such as

    $\bigl(\frac{a}{p}\bigr)$

mathematical notations are rendered on page load by the user's web browser:

![The Legendre symbol: example usage image of the extension](https://raw.githubusercontent.com/antstei/automad-automath/master/images/example_usage_image.png)

## Options

The following options are available:

| Name | Default value | Description |
|------|---------------| ----------- |
| `source` | `'cdn'` | Specifies the include method of KaTeX's JavaScript files. Currently `'cdn'` is the only available method. |
| `defer` | `false` | Specifies whether KaTeX's JavaScript code doesn't need to execute until execute the whole page has loaded. A `true` value can speed up page rendering. |
| `includedPageTags` | `'[]'` | Specifies a list of Automad's page tags to include KaTeX's bootstrap code on those tagged pages. An empty array (`[]`) indicates that the KaTeX's bootstrap code is included on all pages regardless of the current page tags. |
| `includedQueryFields` | `'["filter", "search"]'` | Specifies a list of URL query string fields, such as `filter` or `search`, to include KaTeX's bootstrap code when those fields are part of the current page's URL. An empty array (`[]`) indicates that the KaTeX's bootstrap code is included on all pages regardless of the current page's URL. |
| [`element`](https://katex.org/docs/autorender.html#api) | `'document.body'` | |
| [`delimiters`](https://katex.org/docs/autorender.html#api) | `'[{"left": "$", "right": "$", "display": false}]'` | |
| [`ignoredTags`](https://katex.org/docs/autorender.html#api) | *By default, not set*, hence KaTeX's default value `["script", "noscript", "style", "textarea", "pre", "code"]` is used. | |
| [`ignoredClasses`](https://katex.org/docs/autorender.html#api) | *By default, not set*. | |
| [`errorCallback`](https://katex.org/docs/autorender.html#api) | *By default, not set*. | |
