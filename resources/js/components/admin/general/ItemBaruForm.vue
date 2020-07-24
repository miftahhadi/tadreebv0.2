<template>
    <div>
        <form 
            :action="form.action" 
            method="post" 
            @submit.prevent="checkForm"
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
                            @input="[slugify(), cekJudul(), cekSlug()]"
                            :class="judulInvalid"
                        >

                        <div v-if="errors.hasOwnProperty('judul')" class="invalid-feedback">{{ errors.judul}}</div>
                       
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
                                @input="cekSlug"
                                :class="slugInvalid"
                            >
                        </div>
                        <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                        <small v-if="errors.hasOwnProperty('slug')" class="text-danger">{{ errors.slug }}</small>
                            
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">
                            Deskripsi
                            <!-- <span class="form-label-description">Maks: 600 karakter</span> -->
                        </label>
                        <textarea class="form-control" name="deskripsi" rows="6" placeholder="Deskripsi..."></textarea>
                    
                        <!-- <div class="invalid-feedback">{{ $message }}</div> -->

                    </div>
        
                </div>
                
                <div class="btn-list">
                    <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Batal
                    </button>

                    <input type="submit" value="Simpan" class="btn btn-success" :class="disableSubmit">                     
                </div>

            </div>
        </form>
    </div>
</template>

<script>
// TODO:    - input area belum bisa dikasih class is-invalid kalau error
//          - kalau modal ditutup, input belum kereset
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
            },
            input: {
                judul: '',
                slug: 'judul-' + this.item + '-anda',
                deskripsi: '',
            },
            errors: {},
        }
    },
    methods: {
        slugify() {
            this.input.slug = this.input.judul.toLowerCase().trim().replace(/\s/g, '-');
        },

        cekJudul() {
            if (this.input.judul == 0 ) {
                console.log('Judul error');
                this.errors.judul = 'Judul tidak boleh kosong';
            } else {
                this.errors.judul = null;
            }
        },

        cekSlug() {
            if (this.input.slug == 0 ) {
                console.log('Slug error');
                this.errors.slug = 'Slug URL tidak boleh kosong';
            } else {
                this.errors.slug = null;
            }
        },

    },

    computed: {
        judulInvalid() {
            if (this.errors.hasOwnProperty('judul')) {
                return 'is-invalid';
            }
        },

        slugInvalid() {
            return (this.errors.hasOwnProperty('slug')) ? 'is-invalid' : '';
        },

        disableSubmit() {
            return (this.input.judul.length == 0 || this.input.slug.length == 0) ? 'disabled' : '';
        },
    }
}
</script>