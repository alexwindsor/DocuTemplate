<?php

class ProjectsDb
{


  function __construct($dbConn) {
    $this->dbConn = $dbConn;
  }

  function getProjects() {
    $stmt = $this->dbConn->prepare("SELECT `projects`.`id`, `projects`.`name`, `projects`.`description` FROM `projects`");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function editProject($id) {
    $stmt = $this->dbConn->prepare("UPDATE `projects` SET `projects`.`name` = ?, `projects`.`description` = ? WHERE `projects`.`id` = ?");
    $stmt->execute([$_POST["name"], $_POST["description"], $id]);
  }

  function getProject($id) {

    $stmt = $this->dbConn->prepare("SELECT `projects`.`name`, `projects`.`description`  FROM `projects` WHERE id = ?");
    $stmt->execute([$id]);

    $project_detail = $stmt->fetchAll();

    $stmt = $this->dbConn->prepare("SELECT `section`.`id`, `section`.`title`, `section`.`content`, `section`.`order`  FROM `section` WHERE `section`.`project_id` = ? ORDER BY `section`.`order`");
    $stmt->execute([$id]);

    $project = $stmt->fetchAll();
    $project["name"] = $project_detail[0]["name"];
    $project["description"] = $project_detail[0]["description"];

    return $project;
  }

  function deleteProject($id) {
    $stmt = $this->dbConn->prepare("DELETE FROM `section` WHERE `section`.`project_id` = ?");
    $stmt->execute([$id]);
    $stmt = $this->dbConn->prepare("DELETE FROM `projects` WHERE `projects`.`id` = ?");
    $stmt->execute([$id]);
  }


  function addProject() {
    $stmt = $this->dbConn->prepare("INSERT INTO `projects` (`projects`.`name`, `projects`.`description`) VALUES (?, ?)");
    $stmt->execute([$_POST["name"], $_POST["description"]]);
    return $this->dbConn->lastInsertId();
  }


  function addSection($id) {
    $stmt = $this->dbConn->prepare("INSERT INTO `section` (`section`.`project_id`, `section`.`title`, `section`.`content`, `section`.`order`) values (?, ?, ?, ?)");
    $stmt->execute([$id, $_POST["title"], $_POST["content"], $_POST["order"]]);
  }

  function deleteSection($project_id, $section_id) {
    $stmt = $this->dbConn->prepare("CALL delete_section(?, ?)");
    $stmt->execute([$project_id, $section_id]);
  }

  function editSection($section_id) {
    $stmt = $this->dbConn->prepare("UPDATE `section` SET `section`.`title` = ?, `section`.`content` = ? where `section`.`id` = ?");
    $stmt->execute([$_POST["title"], $_POST["content"], $section_id]);
  }

  function moveSection($project_id, $section_id, $direction) {
    $stmt = $this->dbConn->prepare("CALL move_section(?, ?, ?)");
    $stmt->execute([$project_id, $section_id, $direction]);
  }

}
