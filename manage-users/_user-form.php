<div class="form-group">
    <label for="add_user[username]">Username</label>
    <input type="text" name="add_user[username]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_user['username'] ?>" placeholder="Enter username">
</div>
<div class="form-group">
    <label for="add_user[password]">password</label>
    <input type="text" name="add_user[password]" <? if($readonly) echo 'READONLY'?> value="<?= $edit_user['password'] ?>" placeholder="Enter password">
</div>