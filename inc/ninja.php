<div class="row-fluid">
    <div class="span1">&nbsp;</div>
    <div class="span10">
        <div class="hero-unit last">
            <h1><?php echo $title; ?></h1>
            <form action="/index.php?p=ninja" method="post">
                <label for="books">Enter a list of books&#8212;<em>one book per line, please!</em></label>
                <div class="row-fluid">
                    <div class="span10">
                        <textarea class="span12" rows="15" id="books" name="books">The Ninja Handbook
REAL Ultimate Power
I'm a Ninja, You're a Ninja
NinjaNinjaNinja</textarea>
                    </div>
                    <div class="span1">
                        <button class="btn btn-danger btn-large" type="submit">始めましょう !</button>
                    </div>
                </div>
            </form>
<code><?php
/*
 * Alphabetically sorts an array of strings, disregarding case. Unstable sort.
 */
function quicksort($arr)
{
    if (count($arr) > 1)
    {
        $pivot = strtolower($arr[array_rand($arr)]);
        $less = $equal = $greater = array();

        foreach ($arr as $str)
        {
            $lc_str = strtolower($str);
            if ($lc_str < $pivot)
                $less[] = $str;
            elseif ($lc_str > $pivot)
                $greater[] = $str;
            else
                $equal[] = $str;
        }
        return array_merge(quicksort($less), $equal, quicksort($greater));
    }

    return $arr;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $untrimmed_titles = explode("\n", $_POST['books']);
    $titles = array();

    foreach ($untrimmed_titles as $untrimmed_title)
        $titles[] = trim($untrimmed_title);

    $title_lengths = array_map('strlen', $titles);
    $max_title_length = max($title_lengths);
    $letter_rows = array();
    $titles = quicksort($titles);

    for ($i = 0; $i < $max_title_length; ++$i)
        $letter_rows[$i] = '&nbsp;';

    foreach ($titles as $title)
    {
        $title_length = strlen($title);

        for ($i = 0; $i < $title_length; ++$i)
            $letter_rows[$i] .= $title[$i].'&nbsp;&nbsp;&nbsp;';

        for ( ; $i < $max_title_length; ++$i)
            $letter_rows[$i] .= '&nbsp;&nbsp;&nbsp;&nbsp;';
    }

    foreach ($letter_rows as $letter_row)
        echo $letter_row, '<br>';
}
?></code>
        </div>
    </div>
</div>
