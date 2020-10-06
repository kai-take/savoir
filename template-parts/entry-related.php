<!-- 現在表示している記事の持っている全カテゴリーを取得 -->
<?php if (has_category()) { // カテゴリーを持っているかの判定
        $post_cats = get_the_category(); // 現在表示している投稿が持つ全カテゴリーを配列として一括取得
        $cat_ids = array(); // 配列が代入されるよっていう宣言？
        //所属カテゴリーのIDリストを作っておく
        foreach ($post_cats as $cat)/* 配列を一つずつ取り出し、要素に格納しながら、以下の処理を実行 */ {
            $cat_ids[] = $cat->term_id; // cat_idsには配列としてカテゴリーのターム情報を一つ一つ入れる
        }
    }
    // 条件設定、WP_Queryにパラメーターを渡す
    $myposts = get_posts(array( // 取得する投稿の条件設定
        'post_type' => 'post', // 投稿タイプ
        'posts_per_page' => '4', // 4件を取得, 表示では無く取得である事に注意
        'post__not_in' => array($post->ID), // 表示中の投稿を除外
        'category__in' => $cat_ids, // この投稿と同じカテゴリーに属する投稿の中から
        'orderby' => 'rand' // ランダムに
    ));
    if ($myposts) : // 値が無い時は、空の配列が入る。空文字では無いから注意
?>

<section class="entry-related">
    <h2 class="entry-related__heading">関連記事</h2>
    <div class="entry-related__items">
    <?php foreach ($myposts as $post) : setup_postdata($post); ?>
        <!-- mypostsには8件のデータが格納されてる、それを一つずつ$postに格納 -->
        <article class="entry-related__item">
            <a href="<?php the_permalink(); ?>">
                <div class="entry-related__img">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } else {
                    echo '<div class="entry-related__noImg"></div>';
                }
                ?>
                </div>
                <h3 class="entry-related__title"><?php the_title(); ?></h3><!-- /related-item-title -->
            </a>
        </article>
    <?php endforeach; wp_reset_postdata(); ?>
    </div><!-- entry-related__items -->
</section>
<?php endif; ?><!-- if $myposts のendifだよ。has_categoryのでは無い事に注意 -->