<div class="row" id="main">
      <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Analisa Kriteria</h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kriteria Pertama</th>
                                        <th>Penilaian</th>
                                        <th>Kriteria Kedua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="kriteria in AKriteria">
                                    <tr v-for="colum in kriteria.colums">
                                        <template v-if="colum.IsShow == '1'">
                                        <th>{{kriteria.row}}</th>
                                        <th><select class="form-control"><option>10</option></select></th>
                                        <th>{{colum.row}}</th>
                                        </template>
                                    </tr>    
                                    </template>
                                    
                                </tbody>
                            </table>
                        </div>
       </div>
</div>

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
    const main_script = new Vue({
        el: '#main',
        data: {
            AKriteria:[],
        },
        mounted: function() {
            this.getBuatAnalisaKriteria();
        },
        methods: {
           getBuatAnalisaKriteria: function () {
                axios.get(server_host + '/api/Analisa/buatAnalisaKriteria')
                .then(res =>{ this.AKriteria = res.data;'/'})
                .catch(err => console.error(err));
            },
        },
        
    })
</script>