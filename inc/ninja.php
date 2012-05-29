<div class="box box-center last">
  <h1><?php echo lcfirst($title); ?></h1>

  <form action="/index.php?p=ninja" method="post">
    <label for="books">Enter a list of books&#8212;<em>one book per line, please!</em></label>
    <textarea class="last" rows="10" id="books" name="books"><?php
      if (isset($_POST['books']))
        echo htmlentities($_POST['books'], ENT_QUOTES);
      else
      { ?>The Ninja Handbook
REAL Ultimate Power
I'm a Ninja, You're a Ninja
NinjaNinjaNinja<?php } ?></textarea>

    <button class="btn btn-danger btn-large" type="submit">始 め ま し ょ う !</button>
  </form>

  <code>
<?php
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
  {
    if ($trimmed_title = trim($untrimmed_title))  // Filter out empty lines
      $titles[] = $trimmed_title;
  }

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
      $letter_rows[$i] .= $title[$i].'&nbsp;&nbsp;&nbsp;&nbsp;';

    for ( ; $i < $max_title_length; ++$i)
      $letter_rows[$i] .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
  }

  foreach ($letter_rows as $letter_row)
    echo $letter_row, '<br>';
}
?>
  </code>
</div>
