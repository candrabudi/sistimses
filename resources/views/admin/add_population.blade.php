<div class="offcanvas offcanvas-end" id="add-resident-name" style="width: 30%;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Penduduk</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-resident-name pt-0 row g-2" id="form-add-resident-name" onsubmit="return false">
            <div class="col-sm-12">
                <label class="form-label" for="nik">NIK</label>
                <div class="input-group input-group-merge">
                    <input type="number" id="nik" class="form-control dt-full-name" name="nik" placeholder="" aria-label="" aria-describedby="basicFullname2" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="name">NAMA</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="name" name="name" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="basicPost2" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="gender">JENIS KELAMIN</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">PILIH GENDER</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="phone_number">NO HP</label>
                <div class="input-group input-group-merge">
                    <input type="number" id="phone_number" name="phone_number" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="basicPost2" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="district">KECAMATAN</label>
                <div class="input-group">
                    <div class="col-12">
                        <select id="district" name="district" class="select2 form-select form-select-lg" data-allow-clear="false">
                            <option value="">PILIH KECAMATAN</option>
                            @foreach($districts as $d)
                            <option value="{{$d->province_id}},{{$d->district_id}},{{$d->city_id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="sub_district">DESA</label>
                <div class="input-group input-group-merge">
                    <div class="col-12">
                        <select id="sub_district" name="sub_district" class="select2 form-select form-select-lg" data-allow-clear="false">
                            <option value="">Belum Ada Desa</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="address">ALAMAT</label>
                <div class="input-group input-group-merge">
                    <textarea name="address" class="form-control" id="address" cols="30" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="basicEmail">PENANGGUNG JAWAB</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="person_responsible" name="person_responsible" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="person_responsible" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="information">KETERANGAN</label>
                <div class="input-group input-group-merge">
                    <textarea name="information" class="form-control" id="information" cols="30" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="photo_id">FOTO KTP</label>
                <div class="input-group input-group-merge">
                    <input type="file" id="photo_id" name="photo_id" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="photo_id" />
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" id="submit-data" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>