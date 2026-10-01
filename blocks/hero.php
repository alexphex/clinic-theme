<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Hero')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'title', 'Heading'),
        Field::make('textarea', 'subtitle', 'Subheading'),
        Field::make('image', 'image', 'Image')->set_value_type('url'),
        Field::make('text', 'btn_text', 'Button text'),
        Field::make('text', 'btn_url', 'Button link'),
    ])
    ->set_render_callback(function ($fields) {
        ?>
        <section class="hero">
            <div class="hero__text">
                <?php if (!empty($fields['title'])) : ?>
                    <h1><?php echo esc_html($fields['title']); ?></h1>
                <?php endif; ?>
                <?php if (!empty($fields['subtitle'])) : ?>
                    <p><?php echo esc_html($fields['subtitle']); ?></p>
                <?php endif; ?>
                <?php if (!empty($fields['btn_text']) && !empty($fields['btn_url'])) : ?>
                    <a class="btn" href="<?php echo esc_url($fields['btn_url']); ?>"><?php echo esc_html($fields['btn_text']); ?></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($fields['image'])) : ?>
                <img class="hero__img" src="<?php echo esc_url($fields['image']); ?>" alt="">
            <?php endif; ?>
        </section>
        <?php
    });