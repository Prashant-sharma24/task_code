<?php include 'templates/header.php'; ?>

<div class="row">
    <div class="col-md-12 offset-md-1">
        <h2>Search Images/Videos</h2>
        <?php echo form_open('users/search'); ?>
        <div class="form-group">
            <label for="query">Query:</label>
            <input type="text" name="query" class="form-control" value="<?php echo set_value('query'); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (isset($results)): ?>
            <h3>Results:</h3>
            <div class="row">
                <?php foreach ($results as $result): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo $result['previewURL']; ?>" alt="<?php echo $result['tags']; ?>" class="card-img-top img-fluid img-thumbnail">
                            <div class="card-body">
                                <p class="card-text"><?php echo $result['tags']; ?></p>
                                <a href="<?php echo $result['pageURL']; ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
