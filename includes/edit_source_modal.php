<?php
include 'includes/recruiter_names.php';
?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
  <form id="editForm" method="POST">

      <div class="modal-content border-0 shadow-sm rounded-3">
        <!-- Modal Header -->
<!-- Modal Header -->
<div class="modal-header border-bottom-0 d-flex flex-column align-items-start gap-2" style="background-color: #0e1e40;">
  <!-- Modal Title -->
  <h5 class="modal-title fw-semibold m-0" id="editModalTitle">Edit Record</h5>

  <!-- Status Dropdown below the title -->


  <!-- Close Button positioned absolutely to the top right -->
  <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
 
  <div class="d-flex align-items-center mt-3">

    <select class="form-select form-select-sm" id="edit_status" name="status" required style="min-width: 220px;">
      <option value="">-- Select Status --</option>
      <option value="New">New</option>
      <option value="Previous TA Employee not For Rehire">Previous TA Employee not For Rehire</option>
      <option value="For Rehire Check">For Rehire Check</option>

    </select>
  </div>
</div>



        <div class="modal-body pt-0">
          <!-- Tabs -->
          <ul class="nav nav-tabs mb-3 border-bottom" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sourceTab" type="button" role="tab">Source Info</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#personalTab" type="button" role="tab">Personal Info</button>
            </li>
           
 


          </ul>

          <div class="tab-content">
            <!-- Source Tab -->
            <div class="tab-pane fade show active" id="sourceTab" role="tabpanel">
              <div class="row g-3">
                <input type="hidden" name="personal_info_id" id="edit_personal_info_id">
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Source ID</label>
                  <input readonly type="text" class="form-control" id="edit_source_id" name="source_id">
                </div>
                <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Mode</label>
  <select class="form-control" id="edit_mode" name="mode">
    <option value="">-- Select Mode --</option>
    <option value="Walk-in">Walk-in</option>
    <option value="OTP">OTP</option>
    <option value="Virtual Hub">Virtual Hub</option>
    <option value="Job Fair">Job Fair</option>
    <option value="Phone">Phone</option>
  </select>
</div>

                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Source Date</label>
                  <input type="text" class="form-control" id="edit_source_date" name="source_date">
                </div>
                <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Source</label>
  <select class="form-control" id="edit_source" name="source">
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
                  <input type="text" class="form-control" id="edit_referrer" name="referrer">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Sourced By</label>
                  <input type="text" class="form-control" id="edit_source_by" name="source_by">
                </div>
             <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">Recruiter</label>
  <select class="form-control" id="edit_recruiter" name="recruiter">
    <option value="">-- Select Recruiter --</option>
    <?php foreach ($recruiters as $rec): ?>
      <option value="<?= htmlspecialchars($rec['name']) ?>">
        <?= htmlspecialchars($rec['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Scheduled Interview</label>
                  <input type="date" class="form-control" id="edit_scheduled_interview" name="scheduled_interview">
                </div>
               
              

              </div>
            </div>

            <!-- Personal Tab -->
            <div class="tab-pane fade" id="personalTab" role="tabpanel">
              <div class="row g-3">
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Name</label>
                  <input type="text" class="form-control" id="edit_name" name="name">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Phone</label>
                  <input type="text" class="form-control" id="edit_phone" name="phone">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Age</label>
                  <input type="text" class="form-control" id="edit_age" name="age">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Birthdate</label>
                  <input type="date" class="form-control" id="edit_birthdate" name="birthdate">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Email</label>
                  <input type="email" class="form-control" id="edit_email" name="email">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Address</label>
                  <input type="text" class="form-control" id="edit_address" name="address">
                </div>
            <div class="col-md-6 d-flex">
  <label class="w-50 text-end pe-3 pt-2">City</label>
  <select class="form-control" id="edit_city_municipality" name="city_municipality">
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
  <label class="w-50 text-end pe-3 pt-2">Educational Attainment</label>
  <select class="form-control" id="edit_educational_attainment" name="educational_attainment" required>
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
                  <label class="w-50 text-end pe-3 pt-2">School</label>
                  <input type="text" class="form-control" id="edit_name_of_school" name="name_of_school">
                </div>
                <div class="col-md-6 d-flex">
                  <label class="w-50 text-end pe-3 pt-2">Year Last Attended</label>
                  <input type="text" class="form-control" id="edit_year_last_attended" name="year_last_attended">
                </div>
              

              </div>
            </div>




          </div>
        </div>

        <div class="modal-footer border-top-0">
            <button type="submit" class="btn btn-primary" 
            style="background-color: #0e1e40; border-color: #0e1e40;" 
            onmouseover="this.style.backgroundColor='#f36523'; this.style.borderColor='#f36523';" 
            onmouseout="this.style.backgroundColor='#0e1e40'; this.style.borderColor='#0e1e40';">
            <strong>Save</strong>
          </button>     
        </div>
      </div>
    </form>
  </div>
</div>