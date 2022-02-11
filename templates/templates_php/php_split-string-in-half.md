# Split a string in two almost equal parts
```php
/*
*   Split a string in two parts, return an array
*   @param string
*  
*   @return array
*/
function splitStringInHalf($string) : array {
    $words = str_word_count($string, 1);
    $half = ceil(count($words)/2);
    $first_part = "";
    $second_part = "";
    for($n=0; $n<$half; $n++) {
        $first_part .= $words[$n]." ";
    };
    for($n=$half; $n<count($words); $n++) {
        $second_part .= $words[$n]." "; 
    };
    return array($first_part, $second_part);
}

// To get the results:
$results = splitStringInHalf($string);
$result1 = $results[0];
$result2 = $results[1];

```
+ Problem: let's say we have a 5 words string with 2 first one so much more long than 3 others one
the actual way it works make the first string longer than the second one 
+ ToDo: try to find a way to divide depending on words size when string has an odd number of words)