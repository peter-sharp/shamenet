<div class="form-group">
    <label for="add_shame[description]">description</label>
    <input type="text" name="add_shame[description]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_shame['description'] ?>" placeholder="Enter description">
</div>
<div class="form-group">
    <label for="add_shame[websiteid]">website id</label>
    <input type="number" name="add_shame[websiteid]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_shame['websiteid'] ?>" placeholder="Enter websiteid">
</div>
<div class="form-group">
    <label for="add_shame[userid]">user id</label>
    <input type="number" name="add_shame[userid]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_shame['userid'] ?>" placeholder="Enter userid">
</div>
<div class="form-group">
    <label for="add_shame[rating]">Shame Rating</label>
    <input type="range" name="add_shame[rating]" min="1" max="5" <? if($readonly) echo 'READONLY'?> value="<?= $edit_shame['userid'] ?>" >
</div>