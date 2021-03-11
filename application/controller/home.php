<?php

class Home extends Controller
{

  public function index() {

    $projectsDb = $this->loadModel('ProjectsDb');
    $projects = $projectsDb->getProjects();

    require "application/views/templates/header.php";
    require "application/views/home.php";
    require "application/views/templates/footer.php";

  }
}
