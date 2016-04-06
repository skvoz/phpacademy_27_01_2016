<div class="col-lg-4" style="position: relative">
    <div class="userBlock">
        <table class="table" style="border: 1px solid crimson;">
            <tr>
                <div class="thumbnail">
                    <img src=<?= "uploads/{$item['image']}" ?>>
                </div>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= $item['name'] ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><p style="height: 200px;overflow: scroll;"><?= $item['description'] ?></p></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><?= $item['price'] ?></td>
            </tr>
            <tr>
                <td>Vendor</td>
                <td><?= $item['vendor'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>Add date : <?= $item['add_date'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>Update date : <?= $item['upd_date'] ?></span>
                </td>
            </tr>
        </table>
    </div>
</div>