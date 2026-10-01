<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Doctors')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'section_title', 'Section title'),
        Field::make('complex', 'items', 'Doctors')
            ->set_layout('tabbed-horizontal')
            ->add_fields([
                Field::make('image', 'photo', 'Photo')->set_value_type('url'),
                Field::make('text', 'name', 'Name'),
                Field::make('text', 'specialty', 'Specialty'),
                Field::make('text', 'experience', 'Experience (e.g. 12 years)'),
            ]),
    ])
    ->set_render_callback(function ($fields) {
        ?>
        <section class="doctors">
            <?php if (!empty($fields['section_title'])) : ?>
                <h2><?php echo esc_html($fields['section_title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($fields['items'])) : ?>
                <div class="doctors__grid">
                    <?php foreach ($fields['items'] as $item) : ?>
                        <div class="doctor">
                            <?php if (!empty($item['photo'])) : ?>
                                <img class="doctor__photo" src="<?php echo esc_url($item['photo']); ?>" alt="<?php echo esc_attr($item['name'] ?? ''); ?>">
                            <?php endif; ?>
                            <?php if (!empty($item['name'])) : ?>
                                <h3><?php echo esc_html($item['name']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['specialty'])) : ?>
                                <p class="doctor__specialty"><?php echo esc_html($item['specialty']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($item['experience'])) : ?>
                                <p class="doctor__exp"><?php echo esc_html($item['experience']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
    });