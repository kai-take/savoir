<!-- recommend -->
<section class="recommend">
    <div class="recommend-inner">
        <h2 class="recommend-heading">
            <span class="recommend-heading__title">オススメ記事</span>
        </h2>
        
        <div class="recommend-items">
        <?php //サブループの条件設定
        $recommend_posts = get_posts(array(
            'post_type' => 'post', // 投稿タイプ
            'posts_per_page' => '3', // 3件取得
            'tag' => 'recommend', // recommendタグがついたものを
            'orderby' => 'DESC', // 新しい順に
        ));
        ?>
        <?php foreach ($recommend_posts as $post) : setup_postdata($post); ?>
            
            <article class="recommend__card-container">
                <a href="<?php the_permalink(); //記事のリンク ?>" class="recommend__card">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('large');
                    } else {
                        echo '<div class="recommend__noImg"></div>';
                    } ?>

                    <h3 class="recommend__title"><?php the_title(); //タイトルを表示 ?></h3>
                </a>
            </article>
        <?php endforeach; wp_reset_postdata(); ?>
        </div><!-- /recommend-items -->
    </div><!-- /recommend__inner -->
</section><!-- /recommend -->