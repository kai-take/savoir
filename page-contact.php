<?php get_header(); ?>
<main>
    <section class="contact">
        <div class="contact-inner">
        <?php if (have_posts()) :?>
            <div class="contact-heading">
                <h2><?php the_title(); ?></h2>
                <span>お問い合わせ</span>
            </div>

        <?php the_content(); ?> <!-- 固定ページで書いた内容を反映 -->
        <?php else: echo '<p class="error-text">ページが見つかりませんでした。</p>'?>
        <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>