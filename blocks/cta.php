<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('CTA')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'title', 'Heading'),
        Field::make('text', 'phone', 'Phone number'),
        Field::make('text', 'btn_text', 'Button text'),
        Field::make('color', 'bg_color', 'Background color')
            ->set_default_value('#0a7cff'),
    ])
    ->set_render_callback(function ($fields) {
        $bg    = sanitize_hex_color($fields['bg_color'] ?? '') ?: '#0a7cff';
        $phone = $fields['phone'] ?? '';
        $tel   = preg_replace('/[^0-9+]/', '', $phone);
        ?>
        <section class="cta" style="background-color: <?php echo esc_attr($bg); ?>;">
            <div class="cta__inner">
                <?php if (!empty($fields['title'])) : ?>
                    <h2><?php echo esc_html($fields['title']); ?></h2>
                <?php endif; ?>
                <?php if ($phone) : ?>
                    <p class="cta__phone"><?php echo esc_html($phone); ?></p>
                <?php endif; ?>
                <?php if (!empty($fields['btn_text']) && $tel) : ?>
                    <a class="cta__btn" href="tel:<?php echo esc_attr($tel); ?>"><?php echo esc_html($fields['btn_text']); ?></a>
                <?php endif; ?>
            </div>
        </section>
        <?php
    });