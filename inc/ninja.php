<div class="row-fluid">
    <div class="span1">&nbsp;</div>
    <div class="span10">
        <div class="hero-unit footer">
            <h1>Ninjabook</h1>
            <form action="/index.php?p=ninja" method="post">
                <div class="row-fluid">
                    <label for="books"><p>Enter a list of books&#8212;one
                        book per line, please!</p></label>
                </div>
                <div class="row-fluid">
                    <textarea class="span10" rows="15" id="books" name="books"></textarea>
                    <div class="span1">
                        <button class="btn btn-danger btn-large" type="submit" 
                            name="submit">始めましょう!</button>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span11">&nbsp;</div>
                </div>
            </form>
<tt>
<?php
if (isset($_POST['submit']))
{
    $books = explode("\n", $_POST['books']);
    $title_lengths = array_map('strlen', $books);
    $max_title_length = max($title_lengths);
    $horiz = array();
    sort($books);

    for ($i = 0; $i < $max_title_length; ++$i)
        $horiz[$i] = '&nbsp;';

    foreach ($books as $book)
    {
        $book = trim($book);
        $book_title_length = strlen($book);

        for ($i = 0; $i < $book_title_length; ++$i)
            $horiz[$i] .= $book[$i].'&nbsp; &nbsp;';

        for ($i; $i < $max_title_length; ++$i)
            $horiz[$i] .= '&nbsp; &nbsp; ';
    }

    foreach ($horiz as $h)
        echo $h, '<br>';
}
?>
</tt>
        </div>
    </div>
</div>
