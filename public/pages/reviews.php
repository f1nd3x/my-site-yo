<?php
if($_POST){
    $u = trim($_POST['username']);
    $t = trim($_POST['review_text']);
    
    $s = $pdo->prepare("INSERT INTO reviews (username, review_text) VALUES (?, ?)");
    $s->execute([$u, $t]);
    
    header("Location: index.php?page=reviews");
    exit;
}

$res = $pdo->query("SELECT * FROM reviews ORDER BY dt_created DESC")->fetchAll();
?>

<?php foreach($res as $r){ ?>
    <p>
        <b><?php echo $r['username']; ?></b> 
        (<?php echo $r['dt_created']; ?>): 
        <?php echo $r['review_text']; ?>
    </p>
<?php } ?>

<form method="POST">
    Имя: <input type="text" name="username"><br>
    Текст: <textarea name="review_text"></textarea><br>
    <input type="submit">
</form>