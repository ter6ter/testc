<?php foreach ($comments as $comment):?>
    <?include("templ/comment.php");?>
<?php endforeach;?>
<?php if ($start + count($comments) < $comments_count):?>
<script type="text/javascript">
    $('#show-more').attr('data-loaded', <?=$start + count($comments)?>);
</script>
<?php else:?>
    <script type="text/javascript">
        $('#show-more').hide();
    </script>
<?php endif;?>
