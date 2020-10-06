<!-- ページが1ページ以上あれば以下を表示 -->
<?php if (paginate_links()) : ?>
    <div class="pagenation">
    <?php
    echo paginate_links(
        array(
            'end_size'  => 0, // ページ番号のリストの両端（最初と最後）にいくつの数字を表示するか
            'mid_size'  => 1, // 現在のページの両側にいくつの数字を表示するか
            'prev_next' => true,
            'prev_text' => '<i class="fas fa-angle-left"></i>', // 前のページへのリンクとして表示する文言
            'next_text' => '<i class="fas fa-angle-right"></i>',
        )
    );
    ?>
    </div><!-- /pagenation -->
<?php endif; ?>