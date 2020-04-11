<?php


class LessonPlanMap extends BaseMap
{
   public function existsPlan(LessonPlan $plan){
       $res = $this->db->query("SELECT lesson_plan_id FROM lesson_plan "
           . "WHERE gruppa_id = $plan->gruppa_id AND
subject_id = $plan->subject_id AND user_id = $plan->user_id");
       if ($res->fetchColumn() > 0) {
           return true;
       }
       return false;
   }


    public function save(LessonPlan $plan){
        if ($this->db->exec("INSERT INTO lesson_plan(gruppa_id,subject_id, user_id)"
                . " VALUES($plan->gruppa_id,$plan->subject_id,$plan->user_id)") == 1) {
            return true;
        }
        return false;
    }


    public function findByTeacherId($id=null){
        if ($id) {
            $res = $this->db->query("SELECT
lesson_plan.lesson_plan_id, gruppa.name AS gruppa,
subject.name AS subject, "
                . "subject.hours FROM lesson_plan
INNER JOIN gruppa ON
lesson_plan.gruppa_id=gruppa.gruppa_id "
                . "INNER JOIN subject ON
lesson_plan.subject_id=subject.subject_id WHERE
lesson_plan.user_id=$id");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }



    public function delete($id){
        if ($this->db->exec("DELETE FROM lesson_plan WHERE lesson_plan_id=$id") == 1) {
            return true;
        }
        return false;
    }
}