<?php


class LessonPlan extends Table
{
    
     public $lesson_plan_id=0;
    public $gruppa_id=0;
    public  $subject_id=0;
    public $user_id=0;
    
    public function validate()
    {
        try {
            if (!empty($this->gruppa_id) &&
                !empty($this->subject_id) &&
                !empty($this->user_id)) {
                return true;
            } else {
                throw new Exception('Не переданны все параметры');
            }
} catch (Exception $ex) {
            return false;
        }

        return false;
    }


    public function findTeachers($ofset=0 ,$limit=30){
        $res = $this->db->query("SELECT user.user_id,
CONCAT(user.lastname,' ', user.firstname, ' ',
user.patronymic) AS fio,"
            . " otdel.name AS otdel,
COUNT(lesson_plan.subject_id) AS
count_plan,SUM(subject.hours) AS sum_hours "
            . "FROM user INNER JOIN teacher ON
user.user_id=teacher.user_id INNER JOIN otdel "
            . "ON teacher.otdel_id=otdel.otdel_id
LEFT OUTER JOIN lesson_plan ON
teacher.user_id=lesson_plan.user_id "
            . "LEFT OUTER JOIN subject ON
lesson_plan.subject_id=subject.subject_id GROUP BY
user.user_id "
            . "LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
}