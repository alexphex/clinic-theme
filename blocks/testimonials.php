<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('Testimonials')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'section_title', 'Section title'),
        Field::make('complex', 'items', 'Testimonials')
            ->set_layout('tabbed-horizontal')
            ->add_fields([
                Field::make('text', 'name', 'Patient name'),
                Field::make('textarea', 'text', 'Review'),
                Field::make('select', 'rating', 'Rating')
                    ->set_options([
                        '5' => '5 stars',
                        '4' => '4 stars',
                        '3' => '3 stars',
                        '2' => '2 stars',
                        '1' => '1 star',
                    ]),
            ]),
    ])
    ->set_render_callback(function ($fields) {
        ?>
        <section class="testimonials">
            <?php if (!empty($fields['section_title'])) : ?>
                <h2><?php echo esc_html($fields['section_title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($fields['items'])) : ?>
                <div class="testimonials__grid">
                    <?php foreach ($fields['items'] as $item) :
                        $rating = max(0, min(5, (int) ($item['rating'] ?? 0)));
                        ?>
                        <div class="testimonial">
                            <?php if ($rating) : ?>
                                <div class="testimonial__stars" aria-label="<?php echo esc_attr($rating); ?> out of 5">
                                    <?php echo esc_html(str_repeat('★', $rating) . str_repeat('☆', 5 - $rating)); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($item['text'])) : ?>
                                <p class="testimonial__text"><?php echo esc_html($item['text']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($item['name'])) : ?>
                                <p class="testimonial__name"><?php echo esc_html($item['name']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
    });