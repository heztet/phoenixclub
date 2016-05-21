<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('events/create'); ?>

    <label for="Title">Title</label>
    <input type="input" name="Title" /><br />

    <input type="submit" name="submit" value="Create news item" />

</form>