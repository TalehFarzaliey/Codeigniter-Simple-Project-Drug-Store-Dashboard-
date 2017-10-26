<script src="<?php echo base_url("assets"); ?>/dist/js/third_party/dropzone.js"></script>
<script src="<?php echo base_url("assets"); ?>/dist/js/third_party/bootstrap-toggle.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/dist/js/third_party/jquery.fancybox.min.js"></script>

<script>

    $(document).ready(function () {

        $(".dropzone").dropzone();


        // Bootstrap Toggle init
        $('.toggle_check').bootstrapToggle();

        $('.toggle_check2').change(function () {

            var isCover = $(this).prop('checked');
            var base_url = $(".base_url").text();
            var id       = $(this).attr("dataID");
            $.post(base_url + "drug/isCover", {id: id, isCover: isCover}, function (response) {});

        })
        // isActive Change


        $('.toggle_check').change(function () {

            var isActive = $(this).prop('checked');
            var base_url = $(".base_url").text();
            var id       = $(this).attr("dataID");
            $.post(base_url + "drug/isActiveSetterForImage", {id: id, isActive: isActive}, function (response) {});

        })


    })
    
    $(document).ready(function(){
        //FANCYBOX
        //https://github.com/fancyapps/fancyBox
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });



</script>



<script>

