<div class="column" id="left_col">

  <h2><a href="<?=BASEURL?>">HOME</a> / <?=$project["name"]?></h2>

<?php
for ($i = 0; $i < count($project) - 2; $i++) {
  echo "<a href='#section" . $i . "' class='section'>" . $project[$i]["title"] . "</a>";
}


 ?>

</div>


<div class="column" id="right_col">

<p style="font-size:120%;">
<?=str_replace("\n", "<br />", $project["description"])?>
</p>

<br>

<?php

for ($i = 0; $i < count($project) - 2; $i++) {
?>
<div class="section" id="section_<?=$project[$i]["id"]?>">
  <h4 id="section<?=$i?>"><?=$project[$i]["title"]?></h4>
  <?=str_replace("\n", "<br />", htmlentities($project[$i]["content"]))?>
  <div class="text-right">
    <button type="button" class="btn btn-sm btn-info edit" id="edit_<?=$project[$i]["id"]?>">edit</button>
    <button type="button" class="btn btn-sm btn-danger delete" id="delete_<?=$project[$i]["id"]?>">delete</button>
    <button type="button" class="btn btn-sm btn-warning move" id="up_<?=$project[$i]["id"]?>"<?php if ($project[$i]["order"] == 1) echo " disabled"; ?>>up</button>
    <button type="button" class="btn btn-sm btn-warning move" id="down_<?=$project[$i]["id"]?>"<?php if ($project[$i]["order"] > count($project) - 3) echo " disabled"; ?>>down</button>
  </div>
</div>

<div class="section_edit" id="section_edit_<?=$project[$i]["id"]?>" style="display:none;">
  <form action="<?=BASEURL?>/project/editSection/<?=$id?>/<?=$project[$i]["id"]?>" method="post">
    <br>
    <input class="form-control" type="text" name="title" value="<?=$project[$i]["title"]?>" placeholder="..title">
    <br>
    <textarea class="form-control" name="content" cols="10" placeholder="..content" required><?=$project[$i]["content"]?></textarea>
    <br>
    <input type="submit" class="form-control btn-info" value="EDIT">
    <br><br>
  </form>
</div>
<?php
}
// print_r($project);
 ?>




<hr>

<div class="new_section">
  <form action="<?=BASEURL?>/project/addSection/<?=$id?>" method="post">
    <input class="form-control" type="text" name="title" placeholder="..new section" required>
    <br>
    <textarea class="form-control" name="content" cols="10" placeholder="..content" required></textarea>
    <br>
    <input class="form-control btn-info" type="submit" value="ADD NEW SECTION">
    <input type="hidden" name="order" value="<?=$project[count($project)-3]["order"] + 1?>">
  </form>
</div>



</div>



<script type="text/javascript">

$(".edit").click(function() {

  $("#section_" + this.id.substring(5)).toggle();
  $("#section_edit_" + this.id.substring(5)).toggle();

  $(".edit").prop('disabled', true);
  $(".delete").prop('disabled', true);
  $(".new_section").toggle();

});

$(".delete").click(function() {
  if (confirm("Are you sure you want to delete this section ?")) {
    window.location.href = "<?=BASEURL?>/project/deleteSection/" + <?=$id?> + "/" + this.id.substring(7);
  }
});


$(".move").click(function() {
  var move = this.id.split("_");
  window.location.href = "<?=BASEURL?>/project/moveSection/" + <?=$id?> + "/" + move[1] + "/" + move[0];
  // alert("<?=BASEURL?>/project/moveSection/" + <?=$id?> + "/" + move[1] + "/" + move[0]);
});




</script>
