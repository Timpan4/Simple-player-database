<?php
@session_start();
?>
<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    //decode js json.stringyfy to php object
    $id = json_decode(html_entity_decode($id));
    //add php object array to global variable
    $_SESSION["objects"] = $id;
}
