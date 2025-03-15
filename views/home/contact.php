<?php require_once '../views/common/header.php'; ?>
<?php require_once '../views/common/navbar.php'; ?>

<div class="container">
    <h1>Contact Us</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
            <?php echo $_SESSION['flash_message']['message']; ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_URL; ?>/home/sendContact" method="POST">
        <div>
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" required>
            <span class="error"><?php echo isset($name_err) ? $name_err : ''; ?></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <span class="error"><?php echo isset($email_err) ? $email_err : ''; ?></span>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5" required></textarea>
            <span class="error"><?php echo isset($message_err) ? $message_err : ''; ?></span>
        </div>
        <div>
            <button type="submit">Send Message</button>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>