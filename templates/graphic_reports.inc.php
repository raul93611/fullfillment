<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Graphic reports</h1>
        </div>
        <div class="col-sm-6">

        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-table"></i> RFQ-Team</h3>
            </div>
            <div class="card-body">
              <div class="row mt-4">
                <div class="col-md-6">
                  <h4><i class="fas fa-calendar-alt"></i> From</h4>
                  <div class="row mt-4">
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-sm date" id="date_from" name="date_from" value="">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h4><i class="fas fa-calendar-alt"></i> To</h4>
                  <div class="row mt-4">
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-sm date" id="date_to" name="date_to" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-12">
                  <button type="button" class="btn btn-primary btn-block" id="generate_graphic_report_rfq"><i class="fas fa-play"></i> Generate</button>
                </div>
              </div>
              <div class="mt-3" id="graphic_report_rfq">
                <?php
                RfqFullFillmentPartRepository::rfq_table_report($date_from, $date_to);
                ?>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <canvas id="rfq_pie_report"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
