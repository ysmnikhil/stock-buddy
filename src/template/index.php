<script>
    window['stockVueData'] = <?php echo json_encode($response->all()); ?>
</script>
<?php include_once VUE_FRONT; ?>
