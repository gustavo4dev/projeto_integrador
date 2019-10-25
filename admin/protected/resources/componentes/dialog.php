<dialog id="dialog" class="mdl-dialog">
    <h4 class="mdl-dialog__title"><i class="material-icons">error_outline</i>Mensagem</h4>
    <div class="mdl-dialog__content">
        <h5>
            <?php echo $_SESSION['dialogMessage']; ?>
        </h5>
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button">Ok</button>
    </div>
</dialog>
<script type="text/javascript">
    window.onload = function() {
        var dialog = document.querySelector("#dialog");
        dialog.showModal();
        dialog.querySelector('button:not([disabled])').addEventListener('click', function() {
            dialog.close();
            window.location.href = "<?php echo $_SESSION['dialogRedirect'] ?>";
        });
    };
</script>
