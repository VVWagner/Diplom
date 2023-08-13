<?php
if ($_POST["submit_add"]) {

    $title = $_POST['title'];
    $importanceID = $_POST['importance'];
    $categoryID = $_POST['category'];

    $query = "INSERT INTO Tasks (title, importance, category, userid) VALUES (
            '" . mysqli_real_escape_string($mysqli, $title) . "', 
            " . mysqli_real_escape_string($mysqli, $importanceID) . ",
            " . mysqli_real_escape_string($mysqli, $categoryID) . ",
            " . mysqli_real_escape_string($mysqli, $_SESSION['userid']) . "
        )";

    $result = mysqli_query($mysqli, $query) or die("Ошибка" . mysqli_error($mysqli));

    $id = mysqli_insert_id($mysqli);

    header("Location: home.php");
}
?>

<div class="panel">
    <div id="userid"><?php echo ($_SESSION['userid']) ?></div>

    <a href="/home.php">
        <div class="logo">
            <img src="img/icons/logo.png" alt="">
            <div>PUZZLE</div>
        </div>
    </a>

    <div class="panel__user">
        <?php
        $sql = "SELECT first_name, last_name, image FROM Users WHERE id = " . $_SESSION['userid'] . ";";
        $res = $mysqli->query($sql);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_array($res);
            ?>
            <div class="img__user" id="panelUser">
                <img src="/uploads_images/<?= $row['image'] ?>" alt="">
            </div>
            <?php
        }
        ?>

        <?php
        $sql = "SELECT first_name FROM Users where login='" . $_SESSION['auth_start_login'] . "'";
        $res = $mysqli->query($sql);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_array($res);
            ?>
            <p class="user_name">
                <?= $row['first_name'] ?>
            </p>
            <?php
        }
        ?>


        <img id="btnUserInfo" class="arrow" src="img/icons/arrow.svg" alt="">
    </div>

    <div class="panel__user-info">
        <div class="user-info">
            <a href="/profile.php" class="user-info_item">Профиль</a>
            <a href="/statistic.php" class="user-info_item">Статистика</a>
        </div>
        <div class="user-info-icons">
            <a href="/profile.php" class="user-info_item"><img src="/img/icons/profile.svg" alt=""></a>
            <a href="/statistic.php" class="user-info_item"><img src="/img/icons/statistic.svg" alt=""></a>
        </div>
    </div>

    <div class="panel__list">

        <div class="add__task" id="newTask">
            <img src="/img/icons/plus.svg" alt="">
        </div>


        <a href="/home.php" class="panel__list__item" id="curr_tab">
            <img src="img/icons/2.svg" alt="">
            <p>Текущие</p>
        </a>

        <a href="/completed.php" class="panel__list__item" id="compl_tab">
            <img src="img/icons/3.svg" alt="">
            <p>Выполненные</p>
        </a>

        <a href="/busket.php" class="panel__list__item" id="busk_tab">
            <img src="img/icons/5.svg" alt="">
            <p>Корзина</p>
        </a>
    </div>

    <div class="panel__exit__wrap">
        <a href="/index.php" class="panel__exit">
            <img src="img/icons/exit.svg" alt="">
            <p>Выйти</p>
        </a>
    </div>
</div>