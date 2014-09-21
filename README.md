php-cut-html-string
===================
This function is used to cut a html string but still keep html tags safe.
Example: 
```html
$html_str = '<p>Even though he is suspended, Winston entered the field in full pads and uniform and proceeded to warm up with the <a href="/collegefootball/team/florida-state-seminoles-football/86043" data-cqtag="NCAA/CFB/ACC/Florida_State">Seminoles</a>.</p>';
echo cutHtmlString($html_str);

// OUTPUT:
// <p>Even though he is suspended, Winston entered the field in full pads and uniform and proceeded to war</p>
```
