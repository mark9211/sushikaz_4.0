<div class="alert alert-success" style="position:fixed;top: 70px;z-index:1;display: none;">
    <strong>Success!</strong> <?php echo $message; ?>
</div>
<script>
    $(document).ready(function () {
        $('.alert-success').fadeIn("slow");
        setTimeout(function(){
            $('.alert-success').fadeOut("slow");
        },3000);
    });
</script>