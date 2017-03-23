<div class="alert alert-danger" style="position:fixed;top: 70px;z-index:1;display: none;">
    <strong>Error!</strong> <?php echo $message; ?>
</div>
<script>
    $(document).ready(function () {
        $('.alert-danger').fadeIn("slow");
        setTimeout(function(){
            $('.alert-danger').fadeOut("slow");
        },3000);
    });
</script>