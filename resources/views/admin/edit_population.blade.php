<div class="offcanvas offcanvas-end" id="edit-population-data" style="width: 30%;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Edit Penduduk</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="edit-population-data pt-0 row g-2" id="form-edit-population-data" onsubmit="return false">
            <div class="col-sm-12">
                <label class="form-label" for="e_nik">NIK</label>
                <div class="input-group input-group-merge">
                    <input type="number" id="e_nik" class="form-control dt-full-name" name="e_nik" placeholder="" aria-label="" aria-describedby="basicFullname2" required/>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_name">NAMA</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="e_name" name="e_name" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="basicPost2" required/>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_gender">JENIS KELAMIN</label>
                <select class="form-select" id="e_gender" name="e_gender" required>
                    <option value="">PILIH GENDER</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_phone_number">NO HP</label>
                <div class="input-group input-group-merge">
                    <input type="number" id="e_phone_number" name="e_phone_number" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="basicPost2"required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_district">KECAMATAN</label>
                <div class="col-lg-12">
                    <select class="select2 form-select form-select-lg" data-allow-clear="false" id="e_district" name="e_district" required>
                        <option value="">PILIH KECAMATAN</option>
                        @foreach($districts as $d)
                        <option value="{{$d->district_id}},{{$d->city_id}}">{{$d->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_sub_district">DESA</label>
                <div class="col-lg-12">
                    <select id="e_sub_district" name="e_sub_district" class="select2 form-select form-select-lg" data-allow-clear="false" required>
                        <option value="">PILIH DESA</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_address">ALAMAT</label>
                <div class="input-group input-group-merge">
                    <textarea name="e_address" class="form-control" id="e_address" cols="30" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="basicEmail">PENANGGUNG JAWAB</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="e_person_responsible" name="e_person_responsible" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="e_person_responsible"required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_information">KETERANGAN</label>
                <div class="input-group input-group-merge">
                    <textarea name="e_information" class="form-control" id="e_information" cols="30" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="e_photo_id">FOTO KTP</label>
                <div class="input-group input-group-merge">
                    <input type="file" id="e_photo_id" name="e_photo_id" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="e_photo_id"/>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" id="edit-submit-data" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>