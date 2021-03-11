<div class="container">

<h1>Project Documentation</h1>

<br><br>

<h3>Projects:</h3>

<br /><br />

<?php
foreach ($projects as $project) {
?>
<div id="project_<?=$project["id"]?>">
  <h5><a href="project/<?=$project["id"]?>"><?=$project["name"]?></a></h5>
  <?=str_replace("\n", "<br />", htmlentities($project["description"]))?>
  <div class="text-right">
    <button type="button" class="btn btn-sm btn-info edit" id="edit_<?=$project["id"]?>">edit</button>
    <button type="button" class="btn btn-sm btn-danger delete" id="delete_<?=$project["id"]?>">delete</button>
  </div>
  <hr /><br />
</div>

<div id="project_edit_<?=$project["id"]?>" style="display:none;">
  <form action="<?=BASEURL?>/project/editProject/<?=$project["id"]?>" method="post">
    <input class="form-control" type="hidden" name="id" value="<?=$project["id"]?>">
    <input class="form-control" type="text" name="name" value="<?=$project["name"]?>">
    <br>
    <textarea class="form-control" name="description" rows="10"><?=$project["description"]?></textarea>
    <br>
    <input class="form-control btn-info" type="submit" value="EDIT PROJECT">
    <br><br>
  </form>
</div>
<?php
}
?>
<form action="project/add" method="post">
<input class="form-control" type="text" name="name" placeholder="..new project title" required>
<br>
<textarea class="form-control" name="description" rows="10" required></textarea>
<br>
<input class="form-control btn-info" type="submit" value="ADD NEW PROJECT">
</form>

</div>


<script type="text/javascript">

$(".edit").click(function() {
  $("#project_" + this.id.substring(5)).toggle();
  $("#project_edit_" + this.id.substring(5)).toggle();

});

$(".delete").click(function() {
  if (confirm("Are you sure you want to delete this project ?")) {
    window.location.href = "<?=BASEURL?>/project/delete/" + this.id.substring(7);
  }
});

</script>
