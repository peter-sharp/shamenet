<div class="form-group">
    <label for="add_website[name]">Website Name</label>
    <input type="text" name="add_website[name]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_website['name'] ?>" placeholder="Enter name">
</div>
<div class="form-group">
    <label for="add_website[url]">URL</label>
    <input type="text" name="add_website[url]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_website['url'] ?>" placeholder="Enter url">
</div>