<?php
$fileName = str_replace(".php", "", $_SERVER['SCRIPT_NAME']);
$fileName = str_replace("/", "", $fileName);
?>
<p class="center">
	<a class="btn" href="index.php" target="_self">Books</a> | 
	<?php if($fileName == "index"): ?>
	<a class="btn" href="addBook.php" target="_self">Add Book</a> | 
	<?php endif; ?>
	<a class="btn" href="members.php" target="_self">Members</a> |
	<?php if($fileName == "members"): ?>
	<a class="btn" href="addMember.php" target="_self">Add Member</a> | 
	<?php endif; ?>
	<a class="btn" href="borrowsData.php" target="_self">Borrows</a> |
	<?php if($fileName == "borrowsData"): ?>
	<a class="btn" href="addBorrowData.php" target="_self">Add Data</a>
	<?php endif; ?>
</p>