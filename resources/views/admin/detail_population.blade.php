<div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Detail Penduduk</h3>
                </div>

                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" id="p_photo_id" src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/15.png" width="50%" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4 class="mb-2" id="p_name"></h4>
                        </div>
                    </div>
                </div>
                <p class="mt-4 small text-uppercase text-muted">Detail</p>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="fw-medium me-1 fw-bold">NIK:</span>
                            <span id="p_nik"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">NO. HP:</span>
                            <span id="p_phone_number"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">Jenis Kelamin:</span>
                            <span id="p_gender"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">Kecamatan:</span>
                            <span id="p_district"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">Desa:</span>
                            <span id="p_sub_district"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">Alamat:</span>
                            <span id="p_address"></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-medium me-1 fw-bold">Keterangan:</span>
                            <span id="p_information"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>