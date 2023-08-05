<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to JustPost</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                    <?php 
                    if (isset($login_button)) {
                        echo '<div align="center">'.$login_button .'</div>'; 
                    }
                    
                    
                    ?>
                    </div>
                </div>
                <div class="modal-footer">
                    
                </div>
        </div>
    </div>
</div>