<?php

//Create an instance of our package class...
$testListTable = new DataConLA_List_Table();
//Fetch, prepare, sort, and filter our data...
$testListTable->prepare_items();

?>
<div class="wrap">
    <h2><?php echo $tab; ?> Speakers</h2>

    <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
    <form id="speakers-filter" method="get">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <!-- Now we can render the completed list table -->
        <?php $testListTable->display() ?>
    </form>

</div>