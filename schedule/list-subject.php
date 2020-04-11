<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$subjectMap = new SubjectMap();
$count = $subjectMap->count();
$subjects = $subjectMap->findAll($page*$size-$size, $size);
$header = 'Список изучаемых дисциплин';
require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><?=$header;?></h1>
                    <ol class="breadcrumb">
                        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                        <li class="active"><?=$header;?></li>
                    </ol>
                </section>
                <div class="box-body">

                    <a class="btn btn-success" href="add-subject.php">Добавить дисциплину</a>

                </div>
                <div class="box-body">
                    <?php
                    if ($subjects) {
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Отделение</th>
                                <th>Часы</th>
                                <th>Блокировка</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($subjects as $subject) {
                                echo '<tr>';
                                echo '<td><a href="view-subject.php?id='.$subject->subject_id.'">'.$subject->name.'</a> '. '<a href="add-subject.php?id='.$subject->subject_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$subject->otdel_id.'</td>';
                                echo '<td>'.$subject->hours.'</td>';
                                echo '<td>'.$subject->active.'</td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo 'Ни одной изучаемой дисциплины не найдено';
                    } ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page,$size); ?>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'template/footer.php';
?>