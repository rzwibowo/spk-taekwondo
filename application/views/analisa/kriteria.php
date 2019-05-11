<div class="row">
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
                                    <tr>
                                    
                                    </tr>
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
                .then(res =>{ this.AKriteria = res.data; console.log(this.AKriteria)})
                .catch(err => console.error(err));
            },
        },
        
    })
</script>