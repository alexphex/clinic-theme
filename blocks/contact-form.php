<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Contact Form')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'title', 'Heading'),
        Field::make('text', 'btn_text', 'Button text')->set_default_value('Request appointment'),
    ])
    ->set_render_callback(function ($fields) {
        $status = isset($_GET['form']) ? sanitize_key($_GET['form']) : '';
        ?>
        <section class="contact" id="contact">
            <div class="contact__inner">
                <?php if (!empty($fields['title'])) : ?>
                    <h2><?php echo esc_html($fields['title']); ?></h2>
                <?php endif; ?>

                <?php if ($status === 'sent') : ?>
                    <p class="contact__notice contact__notice--ok">Thank you! We will contact you shortly.</p>
                <?php elseif ($status === 'error') : ?>
                    <p class="contact__notice contact__notice--error">Something went wrong. Please check the fields and try again.</p>
                <?php endif; ?>

                <form class="contact__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <input type="hidden" name="action" value="clinic_contact">
                    <?php wp_nonce_field('clinic_contact', 'clinic_nonce'); ?>

                    <div class="contact__hp" aria-hidden="true">
                        <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <label>Name *
                        <input type="text" name="name" required>
                    </label>
                    <label>Phone *
                        <input type="tel" name="phone" required>
                    </label>
                    <label>Email
                        <input type="email" name="email">
                    </label>
                    <label>Message
                        <textarea name="message" rows="4"></textarea>
                    </label>

                    <button type="submit" class="btn"><?php echo esc_html($fields['btn_text'] ?: 'Send'); ?></button>
                </form>
            </div>
        </section>
        <?php
    });