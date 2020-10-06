<?php get_header(); ?>
<main>
    <section class="privacy">
        <div class="privacy-inner">
        <?php if (have_posts()) :?>
            <div class="privacy-heading">
                <h2><?php the_title(); ?></h2>
                <span>個人情報の取り扱いについて</span>
            </div>
        <?php the_content(); ?>
        <?php else: echo '<p class="error-text">ページが見つかりませんでした。</p>'?>
        <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>