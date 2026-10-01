<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make('FAQ')
    ->set_category('layout')
    ->add_fields([
        Field::make('text', 'section_title', 'Section title'),
        Field::make('complex', 'items', 'Questions')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('text', 'question', 'Question'),
                Field::make('textarea', 'answer', 'Answer'),
            ]),
    ])
    ->set_render_callback(function ($fields) {
        ?>
        <section class="faq">
            <?php if (!empty($fields['section_title'])) : ?>
                <h2><?php echo esc_html($fields['section_title']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($fields['items'])) : ?>
                <div class="faq__list">
                    <?php foreach ($fields['items'] as $item) : ?>
                        <?php if (empty($item['question'])) { continue; } ?>
                        <details class="faq__item">
                            <summary><?php echo esc_html($item['question']); ?></summary>
                            <?php if (!empty($item['answer'])) : ?>
                                <p><?php echo esc_html($item['answer']); ?></p>
                            <?php endif; ?>
                        </details>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
    });