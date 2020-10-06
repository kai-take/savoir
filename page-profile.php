<?php get_header(); ?>
<main>
    <section class="profile">
        <div class="profile-inner">
        <?php if (have_posts()) :?>
            <div class="profile-heading">
                <h2><?php the_title(); ?></h2>
                <span>プロフィール</span>
            </div>
        <?php the_content(); ?>
        <?php else: echo '<p class="error-text">ページが見つかりませんでした。</p>'?>
        <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>