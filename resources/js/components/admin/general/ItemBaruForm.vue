<template>
    <div>
        <form 
            :action="form.action" 
            method="post" 
        >
            <slot>
            </slot>
            <div class="row">
                <div class="col">

                    <div class="form-group mb-3">
                        <label class="form-label required">{{ form.judul }}</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="judul" 
                            placeholder="Tuliskan judul" 
                            v-model="input.judul" 
                            @input="slugify"

                        >

                        <!-- <div v-if="judulInvalid" class="invalid-feedback">Error</div> -->
                       
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label required">
                            {{ form.slug }} 
                        </label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">{{ form.url }}/</span>
                            </span>
                            <input 
                                type="text" 
                                name="slug" 
                                class="form-control" 
                                v-model="input.slug"
                            >
                        </div>
                        <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                        <!-- <small v-if="errors.slug.status" class="text-danger">{{ errors.slug.message }}</small> -->
                            
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
                
                <div class="btn-list">
                    <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Batal
                    </button>

                    <input type="submit" value="Simpan" class="btn btn-success">                    
                </div>

            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'item-baru-form', 
    props: [
        'judul',
        'item',
        'action',
        'url',
        'slug'
    ],
    data() {
        return {
            form: {
                action: this.action,
                judul: this.judul,
                slug: this.slug,
                url: this.url,
                loading: false,
            },
            input: {
                judul: '',
                slug: 'judul-' + this.item + '-anda'
            }
        }
    },
    methods: {
        slugify() {
            this.input.slug = this.input.judul.toLowerCase().trim().replace(/\s/g, '-');
        },

    }
}
</script>