<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', '0000');
define('DB_NAME', 'dotinstall_paging_php');
define('COMMENTS_PER_PAGE', 5);

if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

error_reporting(E_ALL & ~E_NOTICE);

try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from comments limit ".$offset.",".COMMENTS_PER_PAGE;
$comments = array();
foreach ($dbh->query($sql) as $row) {
    array_push($comments, $row);
}
$total = $dbh->query("select count(*) from comments")->fetchColumn();
$totalPages = ceil($total / COMMENTS_PER_PAGE);
$from = $offset + 1;
$to = ($offset + COMMENTS_PER_PAGE) < $total ? ($offset + COMMENTS_PER_PAGE) : $total;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>コメント一覧</title>
</head>
<body>
    <h1>コメント一覧</h1>
    <p>全<?php echo $total; ?>件中、<?php echo $from; ?>件〜<?php echo $to; ?>件を表示しています。</p>
    <ul>
    <?php foreach ($comments as $comment) : ?>
    <li><?php echo htmlspecialchars($comment['comment'],ENT_QUOTES,'UTF-8'); ?></li>
    <?php endforeach; ?>
    </ul>
    <?php if ($page > 1) : ?>
    <a href="?page=<?php echo $page-1; ?>">前</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <?php if ($page == $i) : ?>
        <strong><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></strong>
        <?php else: ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($page < $totalPages) : ?>
    <a href="?page=<?php echo $page+1; ?>">次</a>
    <?php endif; ?>
</body>
</html>