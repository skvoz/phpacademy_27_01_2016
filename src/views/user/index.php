<?php
use testnamespace\Url;

?>

<form method="post" action="<?=Url::to(['/site/index'])?>">
    <input type="text" name="user_name" value=""/>
    <input type="text" name="description" value=""/>
    <input type="submit" name="save" value="save"/>
</form>
<table border="1" cellpadding="1" cellspacing="1">
    <tr>
        <td>username</td>
        <td>description</td>
    </tr>
<?php

foreach ($dataObj as $item) {
    echo sprintf('<tr><td>%s</td><td>%s</td></tr>', $item->user_name, substr($item->description, 0, 50));
}
?>
</table>
