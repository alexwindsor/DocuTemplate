<?php

class Project extends Controller
{

  public function index($id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $project = $projectsDb->getProject($id);

    require "application/views/templates/header.php";
    require "application/views/project.php";
    require "application/views/templates/footer.php";
  }

  public function editProject($id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $id = $projectsDb->editProject($id);
    header("Location: " . BASEURL . "/");
  }

  public function delete($id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $projectsDb->deleteProject($id);

    header("Location: " . BASEURL);
  }

  public function add() {
    $projectsDb = $this->loadModel('ProjectsDb');
    $id = $projectsDb->addProject();
    header("Location: " . BASEURL . "/project/" . $id);
  }

  public function addSection($id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $projectsDb->addSection($id);
    header("Location: " . BASEURL . "/project/" . $id);
  }

  public function deleteSection($project_id, $section_id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $projectsDb->deleteSection($project_id, $section_id);
    header("Location: " . BASEURL . "/project/" . $project_id);
  }

  public function editSection($project_id, $section_id) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $projectsDb->editSection($section_id);
    header("Location: " . BASEURL . "/project/" . $project_id);
  }

  public function moveSection($project_id, $section_id, $direction) {
    $projectsDb = $this->loadModel('ProjectsDb');
    $projectsDb->moveSection($project_id, $section_id, $direction);
    header("Location: " . BASEURL . "/project/" . $project_id);
  }

}
