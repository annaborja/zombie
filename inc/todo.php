<div class="row-fluid">
    <div class="span1">&nbsp;</div>
    <div class="span10">
        <div class="hero-unit last">
            <div class="row-fluid">
                    <h1>TODO</h1>
<?php
function deleteList($dbh, $list_id)
{
    $dbh->exec('DELETE FROM lists WHERE id = '.$list_id);
?>
    <p>List deleted.</p>
<?php
}

function fetchList($dbh, $list_id)
{
            $stmt = $dbh->prepare('SELECT items.id AS item_id, item FROM lists
                LEFT JOIN items ON lists.id=list_id WHERE hash = ?');

            if ($stmt->execute(array($list_id)) && $row = $stmt->fetch())
            {
?>
                    <form action="/index.php?p=todo&list=<?php echo $list_id; ?>"
                        method="post">
                        <p>To EDIT an item, type in its input box</p>
                        <p>To DELETE an item, check its checkbox</p>

                        <ul>
<?php
                do
                {
?>
                            <li><input type="checkbox" name="delete_items[]"
                                value="<?php echo $row['item_id']; ?>">&nbsp;
                                <input class="width90" type="text" name="items[<?php echo $row['item_id']; ?>]"
                                value="<?php echo $row['item']; ?>"></li>
<?php
                } while ($row = $stmt->fetch());
?>
                        </ul>

                        <ul class="bottom-space">
                            <li><button class="btn btn-danger" type="submit"
                                name="update">Update List</button></li>
                            <li><button class="btn btn-danger" type="submit"
                                name="delete">Delete List</button></li>
                        </ul>
                    </form>

                    <form action="/index.php?p=todo&list=<?php echo $list_id; ?>"
                        method="post">
                        <label for="new_item">Add a new item:</label>
                        <input class="width90" type="text" id="new_item" name="new_item"
                            value="New item">&nbsp; <button class="btn btn-danger"
                            type="submit">Add</button>
                    </form><br><br><br>
<?php
            }
}

try
{
    $dbh = new PDO('mysql:host='.$_SERVER['DB1_HOST'].';port='.$_SERVER['DB1_PORT'].
        ';dbname='.$_SERVER['DB1_NAME'], $_SERVER['DB1_USER'], $_SERVER['DB1_PASS']);

    if (isset($_GET['list']) && strlen($_GET['list']) === 32)
    {
        $stmt = $dbh->prepare('SELECT COUNT(*) AS count, list_id FROM lists
            LEFT JOIN items ON lists.id=list_id WHERE hash = ?');
        $stmt->execute(array($_GET['list']));
        $list_info = $stmt->fetch();

        if ($list_info['count'] > 0)
        {
            if (isset($_POST['delete']))
                deleteList($dbh, $list_info['list_id']);
            elseif (isset($_POST['update']))
            {
                if ($list_info['count'] == count($_POST['delete_items']))
                    deleteList($dbh, $list_info['list_id']);
                else
                {
                    $stmt = $dbh->prepare('DELETE FROM items WHERE id = ?');

                    foreach ($_POST['delete_items'] as $delete_item)
                        $stmt->execute(array($delete_item));

                    $stmt = $dbh->prepare('UPDATE items SET item = ? WHERE id = ?');

                    foreach ($_POST['items'] as $k => $item)
                    {
                        if (!in_array($k, $_POST['delete_items']))
                            $stmt->execute(array($item, $k));
                    }
                }
            }
            elseif (isset($_POST['new_item']))
            {
                $stmt = $dbh->prepare('INSERT INTO items VALUES(0, '.$list_info['list_id'].', ?)');
                $stmt->execute(array($_POST['new_item']));
            }

            fetchList($dbh, $_GET['list']);
        }
        else
            echo '<p>Invalid list ID<br><br></p>';
    }
    elseif (isset($_POST['new_list']))
    {
        $new_list_hash = hash('md5', mt_rand());

        $dbh->exec('INSERT INTO lists VALUES (0, "'.$new_list_hash.'")');
        $list_id = $dbh->lastInsertId();
        $stmt = $dbh->prepare('INSERT INTO items VALUES (0, '.$list_id.', ?)');
        $stmt->execute(array($_POST['new_list']));

        fetchList($dbh, $new_list_hash);
    }

    $dbh = null;
?>
                    <form action="/index.php" method="get">
                        <input type="hidden" name="p" value="todo">
                        <label for="list">Fetch an old list:</label>
                        <input class="width50" type="text" id="list" name="list" value="List ID">&nbsp;
                            <button class="btn btn-danger" type="submit">Fetch</button>
                    </form>

                    <form class="last" action="/index.php?p=todo" method="post">
                        <label for="new_list">Create a new list:</label>
                        <input class="width90" type="text" id="new_list" name="new_list"
                            value="New item">&nbsp; <button class="btn btn-danger"
                            type="submit">Create</button>
                    </form>
<?php
}
catch (PDOException $e)
{
    echo '<p>Database connection error.</p>';
}
?>

            </div>
        </div>
    </div>
</div>
