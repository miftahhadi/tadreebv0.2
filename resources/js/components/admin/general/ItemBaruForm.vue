<template>
    <div>
        <form :action="form.action" method="post" @submit="validate">
            <slot>
            </slot>
            <div class="row">
                <div class="col">

                    <div class="form-group mb-3">
                        <label class="form-label required">{{ form.judul }}</label>
                        <input type="text" class="form-control " name="judul" placeholder="Tuliskan judul" value="" v-model="item.judul" @input="slugify">

                        <!-- <div class="invalid-feedback">{{ $message }}</div> -->
                       
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label required">
                            {{ form.slug }} 
                        </label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">{{ form.url }}/</span>
                            </span>
                            <input type="text" name="slug" class="form-control " placeholder="" v-bind:value="item.slug">
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
                
                <div class="btn-list">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </a>

                    <input type="submit" name="submit" value="Simpan" class="btn btn-success">                    
                </div>

            </div>
        </form>
    </div>
</template>

<script>
import VueSuglify from "vue-suglify";

export default {
    name: 'item-baru-form', 
    components: {
        VueSuglify
    },
    props: [
        'judul',
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
            item: {
                judul: '',
                slug: ''
            },
            error: {
                judul: {

                },
                slug: {

                }
            },
        }
    },
    methods: {
        slugify() {
            this.item.slug = this.item.judul.trim().replace(/\s/g, '-');
        },

        validate() {
            return 1;
        }
    },

}
</script>