<div class="box box-center last">
  <h1>TODO</h1>
<?php
function printMsg($msg, $is_success = 0)
{
  echo '<p class="msg ', $is_success ? 'success">' : 'error"><strong>Error:</strong> ', $msg, '</p>';
  return $is_success;
}

function checkList($dbh, $list_hash)
{
  $stmt = $dbh->prepare('SELECT COUNT(*) AS count, lists.id AS list_id FROM
    lists LEFT JOIN items ON lists.id=list_id WHERE hash = ?');

  return ($stmt->execute(array($list_hash)) && ($row = $stmt->fetch()) && $row['count']) ?
    array('id' => $row['list_id'], 'count' => $row['count']) : 0;
}

function fetchList($dbh, $list_id, $list_hash)
{
  global $list_deleted;

  $stmt = $dbh->prepare('SELECT items.id AS item_id, item FROM
    lists LEFT JOIN items ON lists.id=list_id WHERE lists.id = ?');

  if ($stmt->execute(array($list_id)) && $row = $stmt->fetch())
  {
?>
  <form action="/index.php?p=todo&list=<?php echo $list_hash; ?>" method="post">
    <p class="msg">List ID: <?php echo $list_hash; ?></p>

    <p class="print-remove">To EDIT an item, type in its input box and click "Update"</p>

    <p class="print-remove">To DELETE an item, check its checkbox and click "Update"<br>
    **Deleting all items will also delete the list</p>

    <p class="print-remove">The list will PRINT on a clean white background</p>

    <ul>
<?php
    do
    {
      echo '<li><input type="checkbox" name="delete_items[]" value="', $row['item_id'],
        '"> <input class="text-input" type="text" name="items[', $row['item_id'], ']" value="',
        htmlentities($row['item']), '" maxlength="255"></li>';
    } while ($row = $stmt->fetch());
?>
    </ul>

    <ul>
      <li><input class="btn btn-danger btn-large" type="submit" name="update" value="Update"></li>
    </ul>
  </form>

  <form class="bottom-margin" action="/index.php?p=todo&list=<?php echo $list_hash; ?>" method="post">
    <ul>
      <li><label for="new_item">Add a new item:</label>
        <input class="text-input print-remove" type="text" id="new_item" name="new_item"
          value="New item (limit: 255 characters)" maxlength="255">
          <input class="btn btn-danger" type="submit" value="Add"></li>
    </ul>
  </form>
<?php
  }
  elseif (!isset($list_deleted) || !$list_deleted)
    printMsg('Failed to fetch list');
}

function deleteList($dbh, $list_id)
{
  global $list_deleted;

  $list_deleted = printMsg(($is_success = $dbh->exec('DELETE FROM lists WHERE id = '.$list_id)) ?
    'List deleted' : 'Failed to delete list', $is_success);
}

function updateList($dbh, $list_info, $post)
{
  if (!isset($post['delete_items']))
    $post['delete_items'] = array();

  if ($list_info['count'] == count($post['delete_items']))
    deleteList($dbh, $list_info['id']);
  else
  {
    $stmt = $dbh->prepare('DELETE FROM items WHERE id = ?');

    foreach ($post['delete_items'] as $delete_item)
      $is_success = $stmt->execute(array($delete_item));

    $stmt = $dbh->prepare('UPDATE items SET item = ? WHERE id = ?');

    foreach ($post['items'] as $k => $item)
    {
      if (!in_array($k, $post['delete_items']))
        $is_success = $stmt->execute(array($item, $k));
    }

    printMsg($is_success ? 'List updated' : 'Update failed', $is_success);
  }
}

function addListItem($dbh, $list_id, $item)
{
  $stmt = $dbh->prepare('INSERT INTO items VALUES(0, '.$list_id.', ?)');
  
  printMsg(($is_success = $stmt->execute(array($item))) ?
    'Item added to list' : 'Failed to add item to list', $is_success);
}

function createList($dbh, $item)
{
  $list_hash = hash('md5', mt_rand());

  if ($dbh->exec('INSERT INTO lists VALUES (0, "'.$list_hash.'")'))
  {
    $list_id = $dbh->lastInsertId();
    $stmt = $dbh->prepare('INSERT INTO items VALUES (0, '.$list_id.', ?)');

    $stmt->execute(array($item));
    printMsg('New list created! Save this ID: <strong>'.$list_hash.'</strong>', 1);
    fetchList($dbh, $list_id, $list_hash);
  }
  else
    printMsg('Failed to create new list');
}

try
{
  $dbh = new PDO('mysql:host='.$_SERVER['DB1_HOST'].';port='.$_SERVER['DB1_PORT'].
    ';dbname='.$_SERVER['DB1_NAME'], $_SERVER['DB1_USER'], $_SERVER['DB1_PASS']);

  if (isset($_GET['list']))
  {
    if ($list_info = checkList($dbh, $_GET['list']))
    {
      if (isset($_POST['update']))
        updateList($dbh, $list_info, $_POST);
      elseif (isset($_POST['new_item']))
        addListItem($dbh, $list_info['id'], $_POST['new_item']);

      fetchList($dbh, $list_info['id'], $_GET['list']);
    }
    else
      printMsg('List not found');
  }
  elseif (isset($_POST['new_list']))
    createList($dbh, $_POST['new_list']);

  $dbh = null;
?>
  <form action="/index.php" method="get">
    <input type="hidden" name="p" value="todo">

    <ul>
      <li><label for="list">Fetch an old list:</label>
        <input class="text-input input-short print-remove" type="text" id="list" name="list"
          value="<?php echo isset($_GET['list']) ?
            htmlentities($_GET['list']) : '00000000000000000000000000000000'; ?>">
        <input class="btn btn-danger" type="submit" value="Fetch"></li>
    </ul>
  </form>

  <form class="last" action="/index.php?p=todo" method="post">
    <ul>
      <li><label for="new_list">Create a new list:</label>
        <input class="text-input print-remove" type="text" id="new_list" name="new_list"
          value="New item (limit: 255 characters)">
        <input class="btn btn-danger" type="submit" value="Create"></li>
    </ul>
  </form>
<?php
}
catch (PDOException $e)
{
  printMsg('Failed to connect to database');
}
?>
</div>
