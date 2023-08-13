<div class="task__field" id="taskField">
    <form enctype="multipart/form-data" method="post" class="task__field__form">

        <div class="task__field__choose">
            <input class="input_text" type="text" id="taskInput" name="title" placeholder="Новая задача" />

            <div class="wrap__select">
                <div class="box__select">

                    <select class="select__category" id="category_hide" name="category">
                        <option value="hide">Категория</option>

                        <?php

                        $sql = "SELECT id, name FROM Categories";
                        $res = $mysqli->query($sql);

                        if ($res->num_rows > 0) {
                            while ($resArticle = $res->fetch_assoc()) {
                                ?>

                                <option value="<?= $resArticle['id'] ?>">
                                    <?= $resArticle['name'] ?>
                                </option>
                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>

                <div class="box__select">
                    <select class="select__priority" id="priority_hide" name="importance">
                        <option value="hide">Приоритет</option>
                        <?php

                        $sql = "SELECT id, value FROM Importance";
                        $res = $mysqli->query($sql);

                        if ($res->num_rows > 0) {
                            while ($resArticle = $res->fetch_assoc()) {
                                ?>

                                <option value="<?= $resArticle['id'] ?>">
                                    <?= $resArticle['value'] ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="task__field__inputs">
            <div class="add_wrap" id="addWrap">
                <input type="submit" id="submit_form" name="submit_add" class="btn__add btns" value=" "
                    data-title="Добавить">
            </div>
            <div class="cancel_wrap">
                <input id="btnCancel" class="btn__cancel btns" value=" " data-title2="Отменить">
            </div>
        </div>
    </form>
</div>