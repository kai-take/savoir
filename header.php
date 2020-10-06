<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- description 設定 -->
    <?php if ( is_single()): ?>
    <?php if ($post->post_excerpt): ?>
    <meta name="description" content="<? echo $post->post_excerpt; ?>" />
    <?php else : // もし抜粋が設定されていなかったら、本文から引用
            $summary = strip_tags($post->post_content);
            $summary = str_replace("\n", "", $summary);
            $summary = mb_substr($summary, 0, 120). "…"; ?>
    <meta name="description" content="<?php echo $summary; ?>" />
    <?php endif; ?>
    <?php elseif ( is_home() || is_front_page() ): ?>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <?php elseif ( is_category() ): ?>
    <meta name="description" content="<?php echo category_description(); ?>" />
    <?php elseif ( is_tag() ): ?>
    <meta name="description" content="<?php echo tag_description(); ?>" />
    <?php else: ?>
    <meta name="description" content="<?php the_excerpt();?>" /> <!-- ブロックをグループ化しているとexceptの対象から外れる --><!-- ACFで出力した物も外れる -->
    <?php endif; ?>
    
    <!-- エンコード 設定 -->
    <meta charset="utf-8">

    <!-- IEで常に標準モードで表示させる -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Viewport 設定 -->
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?php wp_head(); ?>
</head>

<body>
<div id="wrapper">
    <header class="header">
        <h1 class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img class="logo__img1" src="<?php echo get_template_directory_uri();  ?>/img/savoir.png" alt="savoir">
                <img class="logo__img2" src="<?php echo get_template_directory_uri(); ?>/img/savoir(green).png" alt="savoir">
            </a>
        </h1>
        <p class="description"><?php bloginfo( 'description' ); ?></p>

        <div class="header-container">
            <div class="close-btn"><!-- 通常はdisplay:none -->
                <span></span>
                <span></span>
            </div>
            <!-- 検索フォーム -->
            <?php get_search_form(); ?>

            <div class="header-widget">
            <?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
            <?php dynamic_sidebar( 'header-widget' ); ?>
            <?php endif; ?>
            </div>
            
            <!-- グローバルナビゲーション -->
            <?php
            wp_nav_menu(
                array(
                    'depth' => 1,
                    'theme_location' => 'header', // ヘッダーをここに表示すると指定
                    'container' => 'nav', 
                    'container_class' => 'header__nav',
                    'menu_class' => 'header__list',
                )
            );
            ?>

            <!-- カテゴリーアーカイブ -->
            <?php
            $categories = get_categories(array());
            if ($categories) {
                $cat_selct = '<select name="cat-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;" class="post-catselect">';
                // cat-dropdown=optioneのvalueの値                    // optionがクリックされたら選択されたリンクへ遷移させる
                $cat_selct .= '<option value="" selected="selected">カテゴリーを選択</option>';
                // 結合演算子で、最初の変数に足していく

                // 「カテゴリーから探す」より下をループさせたいから結合演算子を使う。
                foreach ($categories as $category) {
                    $cat_selct .= '<option value="' . esc_html(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</option>';
                }
                $cat_selct .= '</select>';
            };
            ?>

            <div class="category-archive"> <!-- 出力するのはここから -->
                <?php echo $cat_selct;?>
            </div>

            <!-- 月別アーカイブ -->
            <div class="month-archive">
                <select name="month-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
                    <option value=""><?php echo esc_attr(__('Select Month')); ?></option>
                <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?><!-- optionで囲って出力、投稿件数を表示 -->
                </select>
            </div>
        </div><!-- /header-container -->

        <!-- ハンバーガーボタン -->
        <div class="mobile-menu__btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>