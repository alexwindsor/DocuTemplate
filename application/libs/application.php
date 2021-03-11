<?php

/**
 *
 */

class Application
{

  private $controller;
  private $controller_page = NULL;
  private $action = NULL;
  private $id_param = NULL;



  function __construct() {

    $this->sliceUrl() . "";

    if (file_exists("application/controller/" . $this->controller_page . ".php") && $this->controller_page != "project") {
      require "application/controller/" . $this->controller_page . ".php";
      $this->controller = new $this->controller_page();
      define("PAGE", ucfirst($this->controller_page));
      $this->controller->index();
    }
    elseif ($this->controller_page == "project" && isset($this->param1)) {

      require "application/controller/project.php";
      define("PAGE", "Project Documentation");
      $this->controller = new Project;

      if (isset($this->param1) && intval($this->param1) > 0) {
        $this->controller->index($this->param1);
      }
      elseif (isset($this->param1) && method_exists($this->controller, $this->param1) && isset($this->param2) && intval($this->param2) > 0) {
        if (isset($this->param4) && $this->param4 != "") {
          $this->controller->{$this->param1}($this->param2, $this->param3, $this->param4);
        }
        elseif (isset($this->param3) && intval($this->param3) > 0) {
          $this->controller->{$this->param1}($this->param2, $this->param3);
        }
        else {
          $this->controller->{$this->param1}($this->param2);
        }
      }
      elseif (isset($this->param1) && $this->param1 == "add" && isset($_POST)) {
        $this->controller->add();
      }
    }
    elseif (is_null($this->controller_page)) {
      define("PAGE", "HOME");
      require "application/controller/home.php";
      $home = new Home();
      $home->index();
    }
    else {
    header("Location: " . BASEURL . "/pagenotfound/");
      // echo " 404";
    }


  } // end of function __construct





  private function sliceUrl() {

    if (!isset($_GET['url'])) return;

    $url = rtrim($_GET['url'], "/");
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);

    $this->controller_page = $url[0] ?? NULL;
    $this->param1 = $url[1] ?? NULL;
    $this->param2 = $url[2] ?? NULL;
    $this->param3 = $url[3] ?? NULL;
    $this->param4 = $url[4] ?? NULL;

    // echo $this->controller_page . "<br />";
    // echo $this->param1 . "<br />";
    // echo $this->param2 . "<br />";


  } // end of function __construct sliceUrl



} // end of class Application
