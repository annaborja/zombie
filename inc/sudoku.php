<div class="row-fluid">
    <div class="span1">&nbsp;</div>
    <div class="span10">
        <div class="hero-unit footer">
            <h1>Sudoku</h1>
<p><tt>
<?php
$nums = range(1, 9);

for ($i = 0; $i < 9; ++$i)
{
    foreach ($nums as $num)
        echo $num, ' &nbsp; &nbsp;';

    echo '<br><br>';
}
?>
</tt></p>
        </div>
    </div>
</div>
