<template>
    <div>

        <div class="row">
            <div class="col">

                <div class="form-group mb-3">
                    <label class="form-label required">{{ form.judul }}</label>
                    <input type="text" class="form-control " name="judul" placeholder="Tuliskan judul" value="">

                    
                    <!-- <div class="invalid-feedback">{{ $message }}</div> -->
                    

                </div>

                <div class="form-group mb-3">
                    <label class="form-label required">{{ form.slug }}</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                        <!-- <span class="input-group-text">{{ $_SERVER['SERVER_NAME'] }}/{{ $url }}/</span> -->
                        <span class="input-group-text">{{ form.url }}/</span>
                        </span>
                        <input type="text" name="slug" class="form-control " placeholder="" value="">
                    </div>
                    <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                    <!-- <small class="text-danger">{{ $message }}</small> -->
                        
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">
                        Deskripsi
                        <span class="form-label-description">Maks: 600 karakter</span>
                    </label>
                    <textarea class="form-control" name="deskripsi" rows="6" placeholder="Deskripsi..."></textarea>
                
                    <!-- <div class="invalid-feedback">{{ $message }}</div> -->

                </div>
    
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'item-baru-form', 
    data() {
        return {
            form: {
                action: '',
                judul: 'Judul Pelajaran',
                slug: 'Slug',
                url: '',
            },
            error: {
                judul: {

                },
                slug: {

                }
            },
        }
    }
}
</script>