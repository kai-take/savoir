<?php
/* WordPress標準機能 */
function my_setup() {
    add_theme_support('post-thumbnails'); /* アイキャッチ */
    set_post_thumbnail_size( 200, 200, true ); /* アイキャッチ画像のサイズ */
    add_image_size( 200, 200, true );
    add_theme_support('automatic-feed-links'); /* RSSフィード */
    add_theme_support('title-tag'); /* タイトルタグ自動生成 */
    add_theme_support('html5', array( /* HTML5のタグで出力 */
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'my_setup');

/* CSSとJavaScriptの読み込み */
function my_script_init() { // 第一引数の登録名を自分のを書かないと読み込まれない
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
    wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css', array(), '1.0.0', 'all'); 
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'my_script_init');

/* メニューの登録 */
function my_menu_init() {
    register_nav_menus( // ナビゲーションの登録
        array( // メニューの位置を識別する名前 => メニューの説明
            'header' => 'ヘッダーメニュー', 
            'footer' => 'フッターメニュー',
        ));
}
add_action('init', 'my_menu_init');

/* ウィジェットの登録 */
function my_widget_init() {
    register_sidebar( array(
        'name'          => 'ヘッダー',
        'id'            => 'header-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ));

    register_sidebar( array(
        'name'          => 'フッター',
        'id'            => 'footer-widget',
        'before_widget' => '<div id="%1$s" class="widget %2$s">', /* 設置されるウィジェット(検索ボックス等)がdivで囲われるという事 */
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ));

    register_sidebar( array(
        'name'          => 'フッター2',
        'id'            => 'footer-widget2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ));
}
add_action( 'widgets_init', 'my_widget_init' );

/* アーカイブの不要な文字削除 */
function my_archive_title() {
    if (is_category()) {
        $title = single_cat_title('',false);
    } elseif (is_tag()) {
        $title = single_tag_title('',false);
	} elseif (is_tax()) {
	    $title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
	    $title = get_the_time('Y年n月');
	} elseif (is_search()) {
	    $title = '検索結果：'.esc_html( get_search_query(false) );
	} elseif (is_404()) {
	    $title = '「404」ページが見つかりません';
	} else {
	}
    return $title;
}
add_filter( 'get_the_archive_title', 'my_archive_title');

/* excerptの仕様変更(文末の記号を変更) */
function new_excerpt_more($more) {
	return '…'; //変更後の内容
}
add_filter('excerpt_more', 'new_excerpt_more');

/* excerptの仕様変更(文字数の変更) */
function my_excerpt_length($length) {
    return 50;
}
add_filter('excerpt_length', 'my_excerpt_length');

/* タグクラウドの仕様変更(標準styleを除去) */
function wp_tag_cloud_custom_ex( $output ) {
    $output = preg_replace( '/\s*?style="[^"]+?"/i', '',  $output);
    return $output;
}
add_filter( 'wp_tag_cloud', 'wp_tag_cloud_custom_ex');

/* 固定ページに「抜粋」追加*/
add_post_type_support( 'page', 'excerpt' );

/* excerptの<p>タグ削除*/
remove_filter('the_excerpt','wpautop');

function my_posy_search($search) {
    if(is_search()) {
      $search .= " AND post_type = 'post'";
    }
    return $search;
  }
add_filter('posts_search', 'my_posy_search');