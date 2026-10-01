<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Services')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'section_title', 'Section title'),
        Field::make('complex', 'items', 'Services')
            ->set_layout('tabbed-horizontal')
            ->add_fields([
                Field::make('text', 'icon', 'Icon (emoji)'),
                Field::make('text', 'name', 'Name'),
                Field::make('textarea', 'description', 'Description'),
                Field::make('text', 'price', 'Price'),
            ]),
    ])
    ->set_render_callback(function ($fields) {
        ?>
        <section class="services">
            <?php if (!empty($fields['section_title'])) : ?>
                <h2><?php echo esc_html($fields['section_title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($fields['items'])) : ?>
                <div class="services__grid">
                    <?php foreach ($fields['items'] as $item) : ?>
                        <div class="service">
                            <?php if (!empty($item['icon'])) : ?>
                                <div class="service__icon"><?php echo esc_html($item['icon']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($item['name'])) : ?>
                                <h3><?php echo esc_html($item['name']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['description'])) : ?>
                                <p><?php echo esc_html($item['description']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($item['price'])) : ?>
                                <div class="service__price"><?php echo esc_html($item['price']); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
    });