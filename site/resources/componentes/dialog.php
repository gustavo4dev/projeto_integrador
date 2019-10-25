<?php ?>
<script type="text/javascript">
    window.onload = function () {
        $('#myModal').modal();
        $('#close').on('click', function (){
            window.location.href = '<?php echo $_SESSION['modal_redirect']; ?>';
        });
    };
</script>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                
                <h4 class="modal-title" id="myModalLabel">Mensagem</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <?php echo $_SESSION['modal_message'] ?>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">OK</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>


