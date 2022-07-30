<!-- Update Order Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="updateModalLabel">Update Order</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" value="" name="order_id" id="order_id">
          <div class="row">
            <div class="col-12 col-md-12 col-xs-12 mb-3">
              <label class="form-label" for="name">Order Status</label>
              <div class="input-group input-group-dynamic">
                <select id="order_status_modal" name="order_status_modal" class="form-control w-100 border px-2" required onfocus="focused(this)" onfocusout="defocused(this)">
                  <?php foreach($order_status as $ostatus): ?>
                    <option value="<?php echo $ostatus->id; ?>"><?= $ostatus->status; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12 col-xs-12 mb-3">
              <input type="checkbox" name="close_order_modal" id="close_order_modal"> <label class="form-label" for="name">Close Order</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn modal-close bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn modal-submit bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>