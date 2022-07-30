<!-- Export Data Modal -->
<div class="modal fade" id="exportExcelModal" tabindex="1" role="dialog" aria-labelledby="exportExcelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exportExcelModalLabel">Export Order Data</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="export_data_form" action="<?= base_url('order/export_data'); ?>" method="POST">
          <div class="row">
            <div class="col-6 col-md-6 col-xs-12 mb-3">
              <label class="form-label" for="name">Start Date</label>
              <input type="text" id="export_start_date" name="export_start_date">
            </div>
            <div class="col-6 col-md-6 col-xs-12 mb-3">
              <label class="form-label" for="name">End Date</label>
              <input type="text" id="export_end_date" name="export_end_date" disabled>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn modal-close bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn modal-submit bg-gradient-primary">Export Data</button>
      </div>
    </div>
  </div>
</div>