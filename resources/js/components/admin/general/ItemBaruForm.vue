<template>
    <div>
        <form action="{{ action }}" method="post">
            @csrf
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label required">{{ judul }}</label>
                                    <input type="text" class="form-control " name="judul" placeholder="Tuliskan judul" value="">

                                   
                                    <!-- <div class="invalid-feedback">{{ $message }}</div> -->
                                    

                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label required">{{ slug }}</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                        <!-- <span class="input-group-text">{{ $_SERVER['SERVER_NAME'] }}/{{ $url }}/</span> -->
                                        <span class="input-group-text">/</span>
                                        </span>
                                        <input type="text" name="slug" class="form-control " placeholder="" value="">
                                    </div>
                                    <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                                    <!-- <small class="text-danger">{{ $message }}</small> -->
                                      



                                <div class="form-group mb-3">
                                <label class="form-label">
                                    Deskripsi
                                    <span class="form-label-description">Maks: 600 karakter</span>
                                </label>
                                <textarea class="form-controlsi') " name="deskripsi" rows="6" placeholder="Deskripsi..."></textarea>
                                
                               si')
                                
                                <!-- <div class="invalid-feedback">{{ $message }}</div> -->
                               

                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-secondary mr-1">Batal</a>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                    </div>
                </div>

            </form>
    </div>
</template>

<script>
export default {
    
}
</script>