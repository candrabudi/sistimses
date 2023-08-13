<div class="offcanvas offcanvas-end" id="edit-person-responsible" style="width: 30%;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Edit Penanggung Jawab</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="edit-person-responsible pt-0 row g-2" id="form-edit-person-responsible" onsubmit="return false">
            <div class="col-sm-12">
                <label class="form-label" for="e_name">NAMA</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="e_name" name="e_name" class="form-control dt-post" placeholder="" aria-label="" aria-describedby="basicPost2" required/>
                </div>
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
                <button type="submit" id="edit-submit-data" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>