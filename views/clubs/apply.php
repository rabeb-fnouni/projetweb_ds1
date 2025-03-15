<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Apply for <?php echo $club->name; ?></h1>
<form action="<?php echo BASE_URL; ?>/clubs/apply/<?php echo $club->id; ?>" method="POST" enctype="multipart/form-data">
    <div>
        <label for="motivation">Motivation</label>
        <textarea name="motivation" id="motivation" required><?php echo $motivation; ?></textarea>
        <span class="error"><?php echo $motivation_err; ?></span>
    </div>
    <div>
        <label for="cv_file">Upload CV (PDF, DOC, DOCX)</label>
        <input type="file" name="cv_file" id="cv_file" required>
        <span class="error"><?php echo $cv_err; ?></span>
    </div>
    <div>
        <button type="submit">Submit Application</button>
    </div>
</form>
<?php require_once 'views\common\footer.php'; ?>