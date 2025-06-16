<?php
include 'includes/recruiter_names.php';
?>


<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="addForm">
      <div class="modal-content border-0 shadow-sm rounded-3">
       <div class="modal-header" style="background-color: #0e1e40;">
          <h5 class="modal-title fw-bold text-white">Add New Source</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">
          <h6 class="text-primary fw-semibold mb-3">Source Info</h6>
          <div class="row g-3">
            <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Mode <span class="text-danger">*</span></label>
  <select class="form-control" name="mode" required>
    <option value="">-- Select Mode --</option>
    <option value="Walk-in">Walk-in</option>
    <option value="OTP">OTP</option>
    <option value="Virtual Hub">Virtual Hub</option>
    <option value="Job Fair">Job Fair</option>
    <option value="Phone">Phone</option>
  </select>
</div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Source Date <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="source_date" required>
            </div>
            <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Source <span class="text-danger">*</span></label>
  <select class="form-control" name="source" required>
    <option value="">-- Select Source --</option>
    <option value="Facebook">Facebook</option>
    <option value="Referral">Referral</option>
    <option value="School Partnership">School Partnership</option>
    <option value="PESO">PESO</option>
    <option value="NISU">NISU</option>
    <option value="Job Fair">Job Fair</option>
    <option value="DOLE REFERRAL">DOLE REFERRAL</option>
    <option value="Facebook Organic">Facebook Organic</option>
    <option value="B Facebook">B Facebook</option>
    <option value="NA">NA</option>
  </select>
</div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Referrer</label>
              <input type="text" class="form-control" name="referrer">
            </div>
          <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Recruiter <span class="text-danger">*</span></label>
  <select class="form-control" name="recruiter" required>
    <option value="">-- Select Recruiter --</option>
    <?php foreach ($recruiters as $rec): ?>
      <option value="<?= htmlspecialchars($rec['name']) ?>">
        <?= htmlspecialchars($rec['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Scheduled Interview <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="scheduled_interview" required>
            </div>
          </div>

          <hr class="my-4">

          <h6 class="text-primary fw-semibold mb-3">Personal Info</h6>
          <div class="row g-3">
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Phone <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="phone" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Age <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="age" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Birthdate <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="birthdate" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Address <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="address" required>
            </div>
       <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">City <span class="text-danger">*</span></label>
  <select class="form-control" name="city_municipality" required>
    <option value="">-- Select City / Municipality --</option>
    <option value="Iloilo City">Iloilo City</option>
    <option value="Ajuy">Ajuy</option>
    <option value="Alimodian">Alimodian</option>
    <option value="Badiangan">Badiangan</option>
    <option value="Balasan">Balasan</option>
    <option value="Banate">Banate</option>
    <option value="Barotac Viejo">Barotac Viejo</option>
    <option value="Barotac Nuevo">Barotac Nuevo</option>
    <option value="Batad">Batad</option>
    <option value="Bingawan">Bingawan</option>
    <option value="Cabatuan">Cabatuan</option>
    <option value="Calinog">Calinog</option>
    <option value="Carles">Carles</option>
    <option value="Dingle">Dingle</option>
    <option value="Dueñas">Dueñas</option>
    <option value="Dumangas">Dumangas</option>
    <option value="Estancia">Estancia</option>
    <option value="Guimbal">Guimbal</option>
    <option value="Igbaras">Igbaras</option>
    <option value="Janiuay">Janiuay</option>
    <option value="Lambunao">Lambunao</option>
    <option value="Leganes">Leganes</option>
    <option value="Lemery">Lemery</option>
    <option value="Leon">Leon</option>
    <option value="Maasin">Maasin</option>
    <option value="Miag-ao">Miag-ao</option>
    <option value="Mina">Mina</option>
    <option value="New Lucena">New Lucena</option>
    <option value="Oton">Oton</option>
    <option value="Passi">Passi</option>
    <option value="Pavia">Pavia</option>
    <option value="Pototan">Pototan</option>
    <option value="San Dionisio">San Dionisio</option>
    <option value="San Enrique">San Enrique</option>
    <option value="San Joaquin">San Joaquin</option>
    <option value="San Miguel">San Miguel</option>
    <option value="San Rafael">San Rafael</option>
    <option value="Sta. Barbara">Sta. Barbara</option>
    <option value="Sara">Sara</option>
    <option value="Tubungan">Tubungan</option>
    <option value="Tigbauan">Tigbauan</option>
    <option value="Zarraga">Zarraga</option>
    <option value="Negros Occidental">Negros Occidental</option>
    <option value="Negros Oriental">Negros Oriental</option>
    <option value="Guimaras">Guimaras</option>
    <option value="Concepcion">Concepcion</option>
    <option value="Capiz">Capiz</option>
    <option value="Antique">Antique</option>
    <option value="Aklan">Aklan</option>
    <option value="Anilao">Anilao</option>
    <option value="Roxas">Roxas</option>
  </select>
</div>

       <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Educational Attainment <span class="text-danger">*</span></label>
  <select class="form-control" name="educational_attainment" required>
    <option value="">-- Select Educational Attainment --</option>
    <option value="SHS Graduate">SHS Graduate</option>
    <option value="College Undergraduate">College Undergraduate</option>
    <option value="College Graduate">College Graduate</option>
    <option value="HS Graduate (old curriculum)">HS Graduate (old curriculum)</option>
    <option value="Vocational Graduate">Vocational Graduate</option>
    <option value="Not Qualified">Not Qualified</option>
  </select>
</div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">School <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name_of_school" required>
            </div>
            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Year Last Attended <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="year_last_attended" required>
            </div>

            <div class="col-md-6 d-flex">
              <label class="w-50 text-end pe-3 pt-2">Status <span class="text-danger">*</span></label>
             <select class="form-select form-select-sm" id="status" name="status" required style="min-width: 220px;">
      <option value="">-- Select Status --</option>
      <option value="New">New</option>
      <option value="Previous TA Employee not For Rehire">Previous TA Employee not For Rehire</option>
      <option value="For Rehire Check">For Rehire Check</option>
    </select>
    </div>    

          </div>
        </div>

        <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
        <button type="submit"
          class="btn fw-bold text-white px-4"
          style="background-color: #0e1e40; border: none; transition: background-color 0.3s ease;"
          onmouseover="this.style.backgroundColor='#f36523';"
          onmouseout="this.style.backgroundColor='#0e1e40';">
          Add
        </button>
      </div>


        
      </div>
    </form>
  </div>
</div>