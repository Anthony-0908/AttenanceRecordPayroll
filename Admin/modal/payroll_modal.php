
    <!-- Modal -->
    <div class="modal fade" id="AddPayroll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="modal-body">
       <div class="alert alert-warning ">

       </div>
      </div>
      <form id="insertPayroll">
        <div class="modal-body">
            <div class="alert alert-warning d-none">
</div>
            <div class="mb-3">
                <label>Payroll number</label>
                <input type="text" name="payroll_number" class="form-control" value="<?php ?>">
            </div>

            <div class="mb-3">
                <label for="">Full name</label>
                <input type="text" name="fullname" class="form-control"  value="<?php ?>">
            </div>

            <div class="mb-3">
                <label for="">Position</label>
                <input type="text" name="position" class="form-control"  value="<?php ?>">
                
            </div>

            <div class="mb-3">
                <label for="">Total Hours</label>
                <input type="text" name="total_hrs" class="form-control"  value="<?php ?>">
                
            </div>

            <div class="mb-3">
                <label for="">Gross</label>
                <input type="text" name="course" class="form-control"  value="<?php ?>">
                
            </div>

            <div class="mb-3">
                <label for="">SSS</label>
                <input type="text" name="sss" class="form-control">
                
            </div>

            <div class="mb-3">
                <label for="">Phil-health</label>
                <input type="text" name="philhealth" class="form-control"  value="<?php ?>">
                
            </div>

            <div class="mb-3">
                <label for="">Pag-ibig</label>
                <input type="text" name="pag-ibig" class="form-control">
                
            </div>

            <div class="mb-3">
                <label for="">Income Tax</label>
                <input type="text" name="tax" class="form-control">
                
            </div>

            <div class="mb-3">
                <label for="">Net Pay</label>
                <input type="text" name="netpay" class="form-control">
                
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save students</button>
      </div>
      </form>
      </div>
      
    </div>
  </div>