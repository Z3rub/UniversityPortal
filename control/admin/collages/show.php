<?php
	include ("../../include/db/Database.php");
	$db = new Database();
    $sql = "SELECT * FROM tbl_education WHERE PID = 0;";
    $rows = $db->row($db->dbQuery($sql));
?>
<tr>
	<th style="background-color: #ccc;" class="col-sm-1">#</th>
	<th style="background-color: #ccc;" class="col-sm-4">Name</th>
	<th style="background-color: #ccc;" class="col-sm-4">Password</th>
	<th style="background-color: #ccc;" class="col-sm-3">Actions</th>
</tr>
<?php
    foreach ($rows as $row ) {
?>
<tr>
	<td class="col-sm-1"><?=$row[0] ?></td>
	<td class="col-sm-4"><?=$row[1] ?></td>
	<td class="col-sm-4"><?=$row[3] ?></td>
	<td class="col-sm-3">
		<a onclick="my_fun(-1)">NEW</a>
		<a >&nbsp;|&nbsp;</a>
		<a onclick="my_fun(<?= $row[0] ?>)">EDIT</a>
		<a>&nbsp;|&nbsp;</a>
		<a href="delete.php?id=<?= $row[0] ?>" onclick="return confirm('Are You Sure!');">DELETE</a>
	</td>
</tr>
<?php } ?>