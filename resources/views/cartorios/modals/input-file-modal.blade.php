<!-- Modal -->
<div class="modal fade" id="inputFileModalLong" tabindex="-1"
        role="dialog" aria-labelledby="inputFileModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="inputFileModalLongTitle">
                    <i class="fa fa-question-circle"></i>&nbsp;&nbsp;Selecionar arquivo XML</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="conteudoinputFileModalLong">
                <div class="form-group row">
                    <div class="col-md-12 {{ $errors->has('userfile') ? 'text-danger' : '' }}">
                        <input type="file" id="userfile" name="userfile" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSim" class="btn btn-primary" onClick="importDataXML();">Importar Dados</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
