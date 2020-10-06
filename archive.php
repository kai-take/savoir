<?php get_header(); ?>
<main>
    <div class="archive">
        <div class="archive-inner">
            <section class="posts">
                <h2 class="archive__heading"><span><span>「<?php the_archive_title(); ?>」</span>の記事一覧</span></h2><!-- functions.phpで制御 -->
                <div class="card-wrapper">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- whileがあるからループする -->
                    <!-- cardをループさせたいからcardをループ文で挟む -->
                    <article class="card">
                        <a class="card__link" href="<?php the_permalink(); ?>"></a>
                        <div class="card-inner">
                            <div class="card__img">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('large');
                                } else {
                                    echo '<div class="noImg"></div>';
                                } ?>

                                <div class="card__category">
                                    <?php // カテゴリーを一つだけ表示
                                    $category = get_the_category();
                                    if ($category[0]) {
                                        echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
                                    } ?>
                                </div>
                            </div>

                            <div class="card__content">
                                <h3 class="card__title"><?php the_title(); //タイトルを表示 ?></h3>
                                <time class="card__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y/n/j'); ?></time>
                                <div class="card__excerpt"><?php the_excerpt(); //本文の抜粋を表示 ?></div>
                            </div>
                        </div>
                    </article><!-- /card-->
                <?php endwhile;?>
                <?php else: echo '<p class="error-text">記事が見つかりませんでした。</p>'?>
                <?php endif; ?>
                </div><!--  /card-wrapper-->
                <?php get_template_part('template-parts/pagenation'); ?>
            </section>
        </div>
    </div><!-- /inner -->
</main>
<?php get_footer(); ?>