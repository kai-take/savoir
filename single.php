<?php get_header(); ?>
<main>
    <div class="entry">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="entry-inner">
            <div class="entry__title">
                <h2><?php the_title(); ?></h2>
                <div class="entry__time">
                    <time class="entry__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y/n/j'); ?></time>
                    <time class="entry__modified-date" datetime="<?php the_modified_date('c'); ?>"><?php the_modified_date('Y/m/d'); ?></time>
                </div>
            </div>

            <div class="entry__container">
                <div class="entry__img">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('large'); /* noimageはわざわざ表示しなくても良い */
                    }
                    ?>
                </div>
    
                <div class="entry__texts">
                    <!-- ACF -->
                    <p><?php the_field('overview'); ?></p>
                    <h3><?php the_field('heading'); ?></h3>
                    <p><?php the_field('content'); ?></p>
                    <!-- /ACF -->

                    <?php the_content(); ?>

                    <!-- ACF -->
                    <?php $reference = get_field('reference');
                        if( $reference ): ?>
                        <span class="entry__texts-reference"><?php echo $reference; ?></span>
                    <?php endif; ?>
                    <?php $url = get_field('reference-url');
                        if( $url ): ?>
                        <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
                    <?php endif; ?>
                    <!-- /ACF -->
                </div>

                <div class="entry__category"><?php the_category(','); ?></div>
                <div class="entry__tag"><?php the_tags(''); ?></div>
            </div>
        </article><!-- /entry-inner -->
    <?php endwhile;?>
    <?php else: echo '<p class="error-text">記事が見つかりませんでした。</p>'?>
    <?php endif; ?>

        <div class="entry-add">
            <?php get_template_part('template-parts/entry-related'); ?>
        
            <div class="prevNextPost">
            <?php
            $prev_post = get_previous_post(false);
            $next_post = get_next_post(false); 
            function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
            }

            console_log(($prev_post));
            console_log(($next_post));
            ?>
        
            <!-- 一つずつ変数がセットされているか確認しながら進める。テスト環境でエラーが出なくても、本番環境でエラーが出る事がある -->
            <?php 
            if ($prev_post)
            $prev_thumbnail = get_the_post_thumbnail($prev_post->ID); // 投稿IDがあればサムネイルは取得できる。サムネイルが無い場合は""(空文字)が格納
            ?>
            <?php 
            if (isset($prev_thumbnail)) // emptyでも同じ、空文字の時に処理を実行できれば良い。違いは値が入っている時に、issetは実行して、emptyはしない。してもしなくても結局、nullかfalseが入る。
            $prev_test = $prev_thumbnail === ""; // 空文字 の場合 trueが格納
            ?>
            <?php 
            if ($next_post)
            $next_thumbnail = get_the_post_thumbnail($next_post->ID);
            ?>
            <?php 
            if (isset($next_thumbnail))
            $next_test = $next_thumbnail === "";
            ?>
        
            <?php if ($prev_post): ?>
                <article class="prevPost">
                    <a class="prevPost-inner" href="<?php echo get_permalink($prev_post->ID); ?>">
                        <?php if ($prev_test):?>
                            <div class="noImg"></div>
                        <?php else: ?>
                            <?php echo $prev_thumbnail; ?>
                        <?php endif; ?> 
                        <p class="prevPost__title"><?php echo $prev_post->post_title; ?></p>
                    </a>
                </article>
            <?php endif; ?>
        
            <?php if ($next_post): ?>
                <article class="nextPost">
                    <a class="nextPost-inner" href="<?php echo get_permalink($next_post->ID); ?>">
                        <?php if ($next_test):?>
                            <div class="noImg"></div>
                        <?php else: ?>
                            <?php echo $next_thumbnail; ?>
                        <?php endif; ?> 
                        <p class="nextPost__title"><?php echo $next_post->post_title; ?></p>
                    </a>
                </article>
            <?php endif; ?>
            </div>
        </div>
    </div><!-- /entry -->
</main>
<?php get_footer(); ?> 