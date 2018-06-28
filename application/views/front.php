<div class="row" id="app">
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-body pb-0" style="z-index: 1">
                <div class="btn-group float-right">
                    <a href="<?php echo site_url() ?>/mahasiswa" class="btn btn-transparent">
                        <i class="icon-pencil"></i>
                    </a>
                </div>
                <div class="text-value">{{ count_mhs }}</div>
                <div>Mahasiswa Terdata</div>
            </div>
            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                <i class="fa fa-graduation-cap ikon-dash"></i>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
  },
  data: {
  	count_mhs: 0
  },
  methods: {
    GetData()
    {
        axios
            .post('http://localhost/spk-beasiswa/index.php/api/mahasiswa/mahasiswas')
            .then(response => {
                this.count_mhs = response.data.length;
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false )
    },
  }
})

loaderStop()      
</script>